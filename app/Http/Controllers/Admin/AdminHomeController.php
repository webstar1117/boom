<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Auth;



class AdminHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * show dashboard.
     *
     * @return Illuminate\Http\Response
     */

    public function root()
    {
        if (Session::get('lang')) {
            App::setLocale(Session::get('lang'));
        }
        $all_users = User::all();
        $plans = Plan::all();
        return view('admin.list-user', [
            'all_users' => $all_users,
            'plans' => $plans,
        ]);
    }
    public function listUser(Request $request)
    {
        if ($request->path()) {
            $ss = explode("/", $request->path());
            $path = $ss[0] . "." . $ss[1];
        }
        $all_users = User::all();
        $plans = Plan::all();
        if (view()->exists($path)) {
            return view($path, [
                'all_users' => $all_users,
                'plans' => $plans,
            ]);
        }

        return view('pages-404');
    }
    public function createUser(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => ['required', 'string', 'min:6','confirmed'],
            'role'=>'required',
            'membership'=>'required',
        ]);

        User::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
            'plan_id' => $request->input('plan'),
        ]);
        return redirect()->route('admin.list-user');
    }

    public function editUser(Request $request)
    {
        $id = $request->input('id');

        User::whereId($id)->update([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
            'plan_id' => $request->input('plan_id'),
        ]);
        return redirect()->route('admin.list-user');
    }
    public function delUser(Request $request)
    {
        $id = $request->input('id');
        User::whereId($id)->delete();
        return redirect()->route('admin.list-user');
    }

    public function changeBlock(Request $request)
    {
        $id = $request->input('id');
        $block = $request->input('block');
        if ($block == 'active') {
            User::whereId($id)->update([
                'block' => 'block'
            ]);
        } else if ($block == 'block') {
            User::whereId($id)->update([
                'block' => 'active'
            ]);
        }
        echo 'success';
    }
}
