<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use DB;

class AdminLoginController extends Controller
{
    public function __construct()
    {
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:3'
        ]);
        if (User::where('email', $request->email)->exists()) {
            $role = User::where('email', $request->email)->first()->role;
            // Attempt to log the user in
            if ($role == 'admin' && Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                // if successful, then redirect to their intended location
                return redirect()->intended(route('admin.list-user'));
            }
        }

        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }
    public function logout()
    {
        Auth::guard('web')->logout();

        return redirect('/admin/login');
    }
}
