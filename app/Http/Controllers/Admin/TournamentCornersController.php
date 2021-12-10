<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TournamentCorner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class TournamentCornersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function index(Request $request)
    {
        if (Session::get('lang')) {
            App::setLocale(Session::get('lang'));
        }
        if ($request->path()) {
            $ss = explode("/", $request->path());
            $path = $ss[0] . "." . $ss[1];
        }
        if (view()->exists($path)) {
            $all_tournament_corners = TournamentCorner::all();
            return view($path, ['all_tournament_corners' => $all_tournament_corners]);
        }
        return view('pages-404');
    }
    function edit($id)
    {
        $tournament_corner = TournamentCorner::where('id', $id)->first();
        return view('admin.tournament-corners-edit',['tournament_corner'=>$tournament_corner]);
    }
    function confirmEdit(Request $request)
    {
        $id = $request->input('id');
        $tournament_corner = TournamentCorner::where('id', $id)->first();
        $file = $request->file('image');

        if ($file) {
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
            $destinationPath = public_path('/assets/images/gif-files');
            $fileName = time() . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
            //delete old file from public
            File::delete($destinationPath."/".$tournament_corner->image);

            //update datablase to new filename
            TournamentCorner::where('id', $id)->update([
                'image' => $fileName,
            ]);
        }
        return redirect()->route('admin.tournament-corners');
    }
    function delete(Request $request){
        $id=$request->input('id');
        $image=$request->input('image');
        TournamentCorner::where('id',$id)->delete();
        $destinationPath = public_path('/assets/images/gif-files');
        //delete old file from public
        File::delete($destinationPath."/".$image);
        echo 'success';
    }
}
