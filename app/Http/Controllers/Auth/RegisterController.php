<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\EmailOtp;
use App\Models\Food;
use App\Models\Otp;
use App\Models\Player;
use App\Models\TmpMemorial;
use App\Models\UserFood;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Http\Request;


use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\SocialProvider;
use App\Rules\Captcha;
use Illuminate\Support\Facades\Session;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Http;
use Mail;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'otp' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        } else {
            $firstname = $request->firstname;
            $lastname = $request->lastname;
            $email = $request->email;
            $password = $request->password;
            $otp = $request->otp;

            if (Otp::where('email', $email)->where('otp', $otp)->exists()) {
                $user = User::create([
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'email' => $email,
                    'password' => Hash::make($password),
                ]);
                Otp::where('email', $email)->where('otp', $otp)->delete();
                Auth::login($user);
                return redirect('/');
            } else {
                return back()->with('error', 'Invalid OTP!');
            }
        }
    }
    function sendOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        if ($validator->fails()) {
            echo 'invalid-email';
        } else {
            $email = $request->input('email');
            $user = User::where('email', $email)->first();
            $otp = rand(100000, 999999);
            if ($user) {
                Otp::where('email', $email)->update([
                    'otp' => $otp
                ]);
            } else {
                Otp::create([
                    'email' => $email,
                    'otp' => $otp,
                ]);
            }
            $this->sendEmail($email, $otp);
            echo 'success';
        }
    }

    function sendEmail($email, $otp)
    {
        Mail::raw('verification code: ' . $otp, function ($message) use ($email) {
            $message->to($email)->subject("Check verification code");
            $message->from(env('MAIL_USERNAME'), 'code');
        });
    }
}
