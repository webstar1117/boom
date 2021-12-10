<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\TopUp;
use App\Models\TopUpOrder;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class TopUpOrderController extends Controller
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
            $all_top_up_order = TopUpOrder::all();
            return view($path, ['all_top_up_order' => $all_top_up_order]);
        }
        return view('pages-404');
    }

    public function view($id)
    {
        $top_up_order = TopUpOrder::where('top_up_order_id', $id)->first();
        return view('admin.diamond-withdraw-view', ['top_up_order' => $top_up_order]);
    }

    public function accept(Request $request)
    {
        $id = $request->input(('id'));
        $top_up_order=TopUpOrder::where('top_up_order_id', $id)->first();
        $top_up=TopUp::where('top_up_id', $top_up_order->top_up_order_offer)->first();

        //if it is the first top-up, user will receive the bonus.
        if($top_up_order->user->first_top_up==0){
            $total=$top_up->top_up_diamond+$top_up->top_up_first_bonus;
            User::where('id',$top_up_order->top_up_order_user_id)->increment('diamond', $total);
            User::where('id',$top_up_order->top_up_order_user_id)->update(['first_top_up'=>1]);
        }else{
            User::where('id',$top_up_order->top_up_order_user_id)->increment('diamond', $top_up->top_up_diamond);
        }
        TopUpOrder::where('top_up_order_id', $id)->update(['top_up_order_status'=>'approved']);
        echo 'success';
    }

    public function reject(Request $request)
    {
        $id = $request->input(('id'));
        TopUpOrder::where('top_up_order_id', $id)->update(['top_up_order_status'=>'pending']);
        echo 'success';
    }
}
