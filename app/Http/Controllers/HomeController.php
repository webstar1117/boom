<?php

namespace App\Http\Controllers;

use App\Models\Memorial;
use App\Models\MemorialDesignation;
use App\Models\User;
use App\Models\Player;
use App\Models\SiteChat;
use App\Models\Tribute;
use App\Models\Visitor;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        $recent_memorials = Memorial::orderBy('created_at', 'desc')->take(6)->get();
        foreach($recent_memorials as $key=> $mem){
            if($mem->galleries&&count($mem->galleries)){
                foreach($mem->galleries as $gal){
                    if($gal->media_type=='image'){
                        $mem->profile_photo=$gal->media->name;
                        break;
                    }
                }
            }
            
        }
        $number_of_memorials = Memorial::all()->count();
        $number_of_visitors = Visitor::all()->count();
        $number_of_tributes = Tribute::all()->count();
        $memorial_designations = MemorialDesignation::where('id','<>',1)->get();

        if (view()->exists('home')) {

            return view('home', [
                'recent_memorials' => $recent_memorials,
                'number_of_memorials' => $number_of_memorials,
                'number_of_visitors' => $number_of_visitors,
                'number_of_tributes' => $number_of_tributes,
                'memorial_designations' => $memorial_designations,
            ]);
        }
        return view('pages-404');
    }



    public function detail($id)
    {
        if (Session::get('lang')) {
            App::setLocale(Session::get('lang'));
        }
        if($id=='all')
        $memorials=Memorial::take(20)->get();
        else{
            $memorials=Memorial::where('memorial_designation_id',$id)->take(20)->get();
        }

        foreach($memorials as $key=> $mem){
            if($mem->galleries&&count($mem->galleries)){
                foreach($mem->galleries as $gal){
                    if($gal->media_type=='image'){
                        $mem->profile_photo=$gal->media->name;
                        break;
                    }
                }
            }
            
        }
        $designation=null;
        if($id!="all")
        $designation=MemorialDesignation::whereId($id)->first()->name;

        if (view()->exists('home-detail')) {

            return view('home-detail', [
                'memorials' => $memorials,
                'designation' => $designation?$designation:'All',
            ]);
        }
        return view('pages-404');
    }

}
