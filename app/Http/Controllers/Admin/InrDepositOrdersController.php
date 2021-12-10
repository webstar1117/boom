<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\InrDepositOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class InrDepositOrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
           
            $all_inr_deposit_orders=InrDepositOrder::all();
            return view($path,['all_inr_deposit_orders'=>$all_inr_deposit_orders]);        }
        return view('admin.pages-404');
    }
    function delete(Request $request){
        InrDepositOrder::where('id',$request->input('id'))->delete();
        echo 'success';
    }
    function approve(Request $request){
        InrDepositOrder::where('id',$request->input('id'))->update(['status'=>'paid']);
        $inr_deposit_order=InrDepositOrder::where('id',$request->input('id'))->first();
        User::where('id',$request->input('user_id'))->increment('inr',$inr_deposit_order->order_amount);
        echo 'success';
    }

}
