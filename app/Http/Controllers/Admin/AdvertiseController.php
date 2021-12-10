<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Advertise;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class AdvertiseController extends Controller
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
            $all_advertise=Advertise::all();
            return view($path,['all_advertise'=>$all_advertise]);        }
        return view('pages-404');
    }

    public function edit($id)
    {
           $advertise=Advertise::where('advertise_id',$id)->first();
         
           return view('admin.advertise-edit',['advertise'=>$advertise]);
            
    }

    public function confirmEdit(Request $request)
    {
        
        $id=$request->input('id');
        $name=$request->input('name');

        Advertise::where('advertise_id',$id)->update([
            'advertise_name'=>$name,
            ]);
     
            return redirect()->route('admin.advertise');        
    }

    public function confirmAdd(Request $request)
    {
        
        $name=$request->input('name');

            Advertise::insert(
                [
                    'advertise_name'=>$name,
                ]
            );
            return redirect()->route('admin.advertise');        
        
    }


 

}
