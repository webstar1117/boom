<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
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
            $all_sliders=Slider::all();
            return view($path,['all_sliders'=>$all_sliders]);        }
        return view('pages-404');
    }

    public function edit($id)
    {
           $slider=Slider::where('slider_id',$id)->first();
         
           return view('admin.slider-edit',['slider'=>$slider]);
            
    }

    public function editImage(Request $request)
    {
        
        $sliderId=$request->input('slider_id');
        $sliderContent=$request->input('slider_content');
        $slider=Slider::where('slider_id',$sliderId)->first();
        if($sliderContent){
            
            Slider::where('slider_id',$sliderId)->update(['slider_content'=>$sliderContent]);
    
        }
        
        $file = $request->file('image');
        if($file){
            //File Name
            $file->getClientOriginalName();
                    
            //Display File Extension
            $file->getClientOriginalExtension();
            
            //Display File Real Path
            $file->getRealPath();
            
            //Display File Size
            $file->getSize();
            
            //Display File Mime Type
            $file->getMimeType();
            //Move Uploaded File
            $destinationPath = public_path('/assets/images/sliders');
            $fileName=time().$file->getClientOriginalName();
            $file->move($destinationPath,$fileName);

           

            //delete old file from public
            File::delete($destinationPath."/".$slider->slider_image);

            //update datablase to new filename
            Slider::where('slider_id',$sliderId)->update(['slider_image'=>$fileName]);

           
        }
        if($sliderContent==''&&$file==null){
            echo 'input correctly!';
        }else{
            return redirect()->route('admin.slider');        
        }
    }

    public function delete(Request $request)
    {    
        $sliderId=$request->input('id');
       $slider=Slider::where('slider_id',$sliderId)->first();
       $destinationPath = public_path('/assets/images/sliders');

       //delete image file in public folder
       File::delete($destinationPath."/".$slider->slider_image);

       //delete row
       Slider::where('slider_id',$sliderId)->delete();
       echo 'success';
    }

}
