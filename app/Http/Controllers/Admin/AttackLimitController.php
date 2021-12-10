<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\AttackLimit;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class AttackLimitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function index(Request $request){
        if (Session::get('lang')) {
            App::setLocale(Session::get('lang'));
        }
        if($request->path()){
            $ss=explode("/",$request->path());
            $path=$ss[0].".".$ss[1];
        }
        if(view()->exists($path)){
           
            $all_attack_limit=AttackLimit::all();
            return view($path,['all_attack_limit'=>$all_attack_limit]);        }
        return view('admin.pages-404');
    }
    public function edit(Request $request)
    {
   
            $all_attack_limit=AttackLimit::all()[0];
            return view('admin.attack-limit-edit',['all_attack_limit'=>$all_attack_limit]);        
     }
     public function confirmEdit(Request $request)
     {
    
             $id=$request->input('id');
             $min=$request->input('min');
             $max=$request->input('max');
             AttackLimit::where('attack_limit_id',$id)->update(['attack_limit_min'=>$min,'attack_limit_max'=>$max]);
             return redirect()->route('admin.attack-limit');        
            }
}
