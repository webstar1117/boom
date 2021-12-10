<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\DailyGift;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class DailyGiftController extends Controller
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
           
            $all_daily_gift=DailyGift::all();
            return view($path,['all_daily_gift'=>$all_daily_gift]);        }
        return view('admin.pages-404');
    }
    public function edit(Request $request)
    {
   
            $all_daily_gift=DailyGift::all();
            return view('admin.daily-gift-edit',['all_daily_gift'=>$all_daily_gift]);        
     }

     public function confirmEdit(Request $request)
     {
    
             $id=$request->input('id');
             $min=$request->input('min');
             $max=$request->input('max');
             DailyGift::where('daily_gift_id',$id)->update(['daily_gift_min'=>$min,'daily_gift_max'=>$max]);
             return redirect()->route('admin.daily-gift');        
            }
    

}
