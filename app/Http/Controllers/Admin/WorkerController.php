<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Worker;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class WorkerController extends Controller
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
            $all_worker=Worker::all();
            return view($path,['all_worker'=>$all_worker]);        }
        return view('pages-404');
    }

    public function edit($id)
    {
           $worker=Worker::where('worker_id',$id)->first();
         
           return view('admin.worker-edit',['worker'=>$worker]);
            
    }

    public function confirmEdit(Request $request)
    {
        
        $id=$request->input('id');
        $name=$request->input('name');
        $minute=$request->input('minute');
        $gem=$request->input('gem');
        $status=$request->input('status');

        $worker=Worker::where('worker_id',$id)->first();
        Worker::where('worker_id',$id)->update([
            'worker_name'=>$name,
            'worker_minute'=>$minute,
            'worker_gem'=>$gem,
            'worker_status'=>$status,
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
            $destinationPath = public_path('/assets/images/workers');
            $fileName=time().$file->getClientOriginalName();
            $file->move($destinationPath,$fileName);

           

            //delete old file from public
            File::delete($destinationPath."/".$worker->worker_image);

            //update datablase to new filename
            Worker::where('worker_id',$id)->update(['worker_image'=>$fileName]);

           
        }
     
            return redirect()->route('admin.worker');        
    }

 

}
