<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TmpMemorial;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

use Auth;
use Socialite;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {      
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }  
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->back()->with('error', 'Invalid User!');
        }
        return redirect('/');
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }
        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider(Request $request,$provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
            // only allow people with @company.com to login
            // if(explode("@", $user->email)[1] !== 'company.com'){
            //     return redirect()->to('/');
            // }
            // check if they're an existing user
            $existingUser = User::where('email', $user->email)->first();

            if ($existingUser) {
                // log them in
                Auth::loginUsingId($existingUser->id);
            } else {
                $newUser = new User;
                $newUser->firstname = explode(' ', $user->name)[0];
                $newUser->lastname = explode(' ', $user->name)[1];
                $newUser->email = $user->email;
                $newUser->save();
                Auth::loginUsingId($newUser->id);
            }
            return redirect('/');
        } catch (\Exception $e) {
            return redirect('/auth-login');
        }
    }
}
