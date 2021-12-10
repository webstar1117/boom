<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class FoodController extends Controller
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
            $all_food=Food::all();
            return view($path,['all_food'=>$all_food]);        }
        return view('pages-404');
    }

    public function edit($id)
    {
           $food=Food::where('foods_id',$id)->first();
           return view('admin.food-edit',['food'=>$food]);
            
    }

    public function confirmEdit(Request $request)
    {
        
        $id=$request->input('id');
        $name=$request->input('name');
        $health=$request->input('health');
        $status=$request->input('status');

        $food=Food::where('foods_id',$id)->first();
        Food::where('foods_id',$id)->update([
            'foods_name'=>$name,
            'foods_health_capacity'=>$health,
            'foods_status'=>$status,
            ]);

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
            $destinationPath = public_path('/assets/images/foods');
            $fileName=time().$file->getClientOriginalName();
            $file->move($destinationPath,$fileName);

           

            //delete old file from public
            File::delete($destinationPath."/".$food->foods_image);

            //update datablase to new filename
            Food::where('foods_id',$id)->update(['foods_image'=>$fileName]);

           
        }
     
        return redirect()->route('admin.food');        
        
    }

    public function delete(Request $request)
    {    
        $id=$request->input('id');
       $food=Food::where('foods_id',$id)->first();
       $destinationPath = public_path('/assets/images/foods');

       //delete image file in public folder
       File::delete($destinationPath."/".$food->foods_image);

       //delete row
       Food::where('foods_id',$id)->delete();
       echo 'success';
    }

}
