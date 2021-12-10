<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;
use Auth;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }
    function sendNumber(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        } else {
            $email = $request->input('email');
            $user = User::where('email', $email)->first();
            if ($user) {
                $otp = rand(100000, 999999);
                User::where('email', $email)->update([
                    'otp' => $otp
                ]);
                $this->sendEmail($email, $otp);
                return redirect('/reset-password/email/verify/' . $user->id);
            } else {
                return redirect('/auth-login/reset')->with('error', 'There is no registered email!');
            }
        }
    }
    function emailVerify($id)
    {
        if ($id && User::whereId($id)->exists()) {
            $email = User::whereId($id)->first()->email;
            if ($email) {
                return view('email-verify', [
                    'email' => $email
                ]);
            } else {
                return view('pages-404');
            }
        } else {
            return view('pages-404');
        }
    }
    function verifyNumber(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'verify_number' => ['required', 'numeric'],
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        } else {
            $verify_number = $request->input('verify_number');
            $email = $request->input('email');
            $password = $request->input('password');
            if (User::where('email', $email)->exists()) {
                $otp = User::where('email', $email)->first()->otp;
                // dd($otp);
                if ($otp == $verify_number) {
                    User::where('email', $email)->update([
                        'password' => Hash::make($password),
                        'otp' => null,
                    ]);
                    $user = User::where('email', $email)->first();
                    Auth::login($user);
                    return redirect('/');
                } else {
                    return redirect()->back()->with('error', 'Verification code is incorrect!');
                }
            }
        }
    }

    function sendEmail($email, $otp)
    {
        Mail::raw('verification code: ' . $otp, function ($message) use ($email) {
            $message->to($email)->subject("Check verification code");
            $message->from(env('MAIL_USERNAME'), 'kifo.org');
        });
    }
}
