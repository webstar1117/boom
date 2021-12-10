<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class PlayerController extends Controller
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
            $all_player=Player::all();
            return view($path,['all_player'=>$all_player]);        }
        return view('pages-404');
    }

    public function edit($id)
    {
           $player=Player::where('player_id',$id)->first();
         
           return view('admin.player-edit',['player'=>$player]);
            
    }

    public function confirmEdit(Request $request)
    {
        
        $id=$request->input('id');
        $name=$request->input('name');
        $minute=$request->input('minute');
        $capacity=$request->input('capacity');
        $price=$request->input('price');
        $price_type=$request->input('price_type');
        $membership=$request->input('membership');
        $daily_limit=$request->input('daily_limit');
        $player_duration=$request->input('player_duration');
        $status=$request->input('status');

        $player=Player::where('player_id',$id)->first();
        Player::where('player_id',$id)->update([
            'player_name'=>$name,
            'player_minute'=>$minute,
            'player_capacity'=>$capacity,
            'player_price'=>$price,
            'player_price_type'=>$price_type,
            'player_membership'=>$membership,
            'player_daily_limit'=>$daily_limit,
            'player_duration'=>$player_duration,
            'player_status'=>$status,
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
            $destinationPath = public_path('/assets/images/players');
            $fileName=time().$file->getClientOriginalName();
            $file->move($destinationPath,$fileName);

           

            //delete old file from public
            File::delete($destinationPath."/".$player->player_image);

            //update datablase to new filename
            Player::where('player_id',$id)->update(['player_image'=>$fileName]);

           
        }
     
            return redirect()->route('admin.player');        
        
    }

    public function confirmAdd(Request $request)
    {
        
        $name=$request->input('name');
        $minute=$request->input('minute');
        $capacity=$request->input('capacity');
        $price=$request->input('price');
        $price_type=$request->input('price_type');
        $membership=$request->input('membership');
        $daily_limit=$request->input('daily_limit');
        $status=$request->input('status');
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
            $destinationPath = public_path('/assets/images/players');
            $fileName=time().$file->getClientOriginalName();
            $file->move($destinationPath,$fileName);

            Player::insert(
                [
                    'player_name'=>$name,
                    'player_minute'=>$minute,
                    'player_capacity'=>$capacity,
                    'player_price'=>$price,
                    'player_price_type'=>$price_type,
                    'player_membership'=>$membership,
                    'player_daily_limit'=>$daily_limit,
                    'player_status'=>$status,
                    'player_image'=>$fileName,
                    ]
            );
        }
     
            return redirect()->route('admin.player');        
        
    }


 

}
