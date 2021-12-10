<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\DiamondWithdraw;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class DiamondWithdrawController extends Controller
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
            $all_diamond_withdraw = DiamondWithdraw::all();
            return view($path, ['all_diamond_withdraw' => $all_diamond_withdraw]);
        }
        return view('pages-404');
    }

    public function view($id)
    {
        $diamond_withdraw = DiamondWithdraw::where('diamond_withdraw_id', $id)->first();
        return view('admin.diamond-withdraw-view', ['diamond_withdraw' => $diamond_withdraw]);
    }

    public function accept(Request $request)
    {
        $id = $request->input(('id'));
        DiamondWithdraw::where('diamond_withdraw_id', $id)->update(['diamond_withdraw_status'=>'paid']);
        echo 'success';
    }

    public function reject(Request $request)
    {
        $id = $request->input(('id'));
        $diamond_withdraw = DiamondWithdraw::where('diamond_withdraw_id', $id)->first();
        User::where('id',$diamond_withdraw->diamond_withdraw_id)
        ->increment('diamond',$diamond_withdraw->diamond_withdraw_amount+$diamond_withdraw->diamond_withdraw_fee);
        DiamondWithdraw::where('diamond_withdraw_id', $id)->update(['diamond_withdraw_status'=>'uppaid']);
        echo 'success';
    }
}
