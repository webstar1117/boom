<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\InrWithdraw;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class InrWithdrawController extends Controller
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
            $all_inr_withdraw = InrWithdraw::all();
            return view($path, ['all_inr_withdraw' => $all_inr_withdraw]);
        }
        return view('pages-404');
    }

    public function view($id)
    {
        $inr_withdraw = InrWithdraw::where('inr_withdraw_id', $id)->first();
        return view('admin.inr-withdraw-view', ['inr_withdraw' => $inr_withdraw]);
    }

    public function accept(Request $request)
    {
        $id = $request->input(('id'));
        InrWithdraw::where('inr_withdraw_id', $id)->update(['inr_withdraw_status'=>'paid']);
        echo 'success';
    }

    public function reject(Request $request)
    {
        $id = $request->input(('id'));
        $inr_withdraw = InrWithdraw::where('inr_withdraw_id', $id)->first();
        User::where('id',$inr_withdraw->inr_withdraw_id)
        ->increment('inr',$inr_withdraw->inr_withdraw_amount+$inr_withdraw->inr_withdraw_fee);
        InrWithdraw::where('inr_withdraw_id', $id)->update(['inr_withdraw_status'=>'uppaid']);
        echo 'success';
    }
}
