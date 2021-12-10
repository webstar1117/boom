<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\DailyGift;
use App\Models\InrDepositLimit;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class InrDepositLimitController extends Controller
{
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
           
            $all_inr_deposit_limit=InrDepositLimit::all();
            return view($path,['all_inr_deposit_limit'=>$all_inr_deposit_limit]);        }
        return view('admin.pages-404');
    }

    public function edit(Request $request)
    {
   
            $all_inr_deposit_limit=InrDepositLimit::all();
            return view('admin.inr-deposit-limit-edit',['all_inr_deposit_limit'=>$all_inr_deposit_limit]);        
     }
     public function confirmEdit(Request $request)
    {
   
        $id=$request->input('id');
        $fee=$request->input('fee');
        $min=$request->input('min');
        $max=$request->input('max');
        InrDepositLimit::where('inr_deposit_limit_id',$id)->update([
            'inr_deposit_limit_fee'=>$fee,
            'inr_deposit_limit_min'=>$min,
            'inr_deposit_limit_max'=>$max
            ]);
        return redirect()->route('admin.inr-deposit-limit');          
     }
}
