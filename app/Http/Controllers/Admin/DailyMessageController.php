<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\DailyMessage;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class DailyMessageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
       
        if (Session::get('lang')) {
            App::setLocale(Session::get('lang'));
        }
        if($request->path()){
            $ss=explode("/",$request->path());
            $path=$ss[0].".".$ss[1];
        }
        if(view()->exists($path)){
            $all_daily_message=DailyMessage::all();
            return view($path,['all_daily_message'=>$all_daily_message]);        }
        return view('pages-404');
    }

    public function searchUser(Request $request)
    {
           $search_str=$request->input('val');
           $user = User::where('name',$search_str)->orWhere('email',$search_str)->first();
            echo $user->name;   
    }
    public function add(Request $request)
    {
           $username=$request->input('user');
           $content=$request->input('content');
           DailyMessage::insert(
            [
                'daily_message_username'=>$username,
                'daily_message_content'=>$content,
                'daily_message_status'=>0,
                'daily_message_created_date'=>date("Y-m-d h:i:s"),
            ]
        );
            echo 'success';   
    }

    public function edit(Request $request)
    {
           $id=$request->input('id');
           $username=$request->input('user');
           $content=$request->input('content');
           DailyMessage::where('daily_message_id',$id)->update(
            [
                'daily_message_username'=>$username,
                'daily_message_content'=>$content,
                'daily_message_status'=>0,
                'daily_message_created_date'=>date("Y-m-d h:i:s"),
            ]
        );
            echo 'success';   
    }

    public function delete(Request $request)
    {
           $id=$request->input('id');
           DailyMessage::where('daily_message_id',$id)->delete();
            echo 'success';   
    }

 

}
