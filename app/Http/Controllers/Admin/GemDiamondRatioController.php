<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\GemDiamondRatio;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class GemDiamondRatioController extends Controller
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
            $all_gem_diamond_ratio = GemDiamondRatio::all()[0];
            return view($path, ['all_gem_diamond_ratio' => $all_gem_diamond_ratio]);
        }
        return view('pages-404');
    }

    public function update(Request $request)
    {
        $id=$request->input('id');
        $gem=$request->input('gem');
        $diamond=$request->input('diamond');
        GemDiamondRatio::where('id',$id)->update(['gem'=>$gem, 'diamond'=>$diamond]);
        return redirect()->route('admin.gem-diamond-ratio');
    }
}
