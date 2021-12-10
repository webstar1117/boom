<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use App\Models\TournamentType;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;

class TournamentController extends Controller
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
            $all_tournament = Tournament::all();
            return view($path, ['all_tournament' => $all_tournament]);
        }
        return view('pages-404');
    }
    function add()
    {
        $all_tournament_type = TournamentType::all();
        return view('admin.tournament-add', ['all_tournament_type' => $all_tournament_type]);
    }
    function confirmAdd(Request $request)
    {
        $title = $request->input('title');
        $amount = $request->input('amount');
        $fee = $request->input('fee');
        $tournament_type = $request->input('tournament_type');
        $registered_users_limit = $request->input('registered_users_limit');

        $tournament = new Tournament;
        $tournament->title = $title;
        $tournament->amount = $amount;
        $tournament->fee = $fee;
        $tournament->tournament_type = $tournament_type;
        $tournament->registered_users_limit = $registered_users_limit;
        $tournament->save();
        $LastInsertId = $tournament->id;
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
            $destinationPath = public_path('/assets/images/tournaments');
            $fileName = time() . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
            Tournament::where('id', $LastInsertId)->update([
                'image' => $fileName,
            ]);
        }

        return redirect()->route('admin.tournament');
    }
    function edit($id)
    {
        $all_tournament_type = TournamentType::all();
        $tournament = Tournament::where('id', $id)->first();
        return view('admin.tournament-edit', [
            'all_tournament_type' => $all_tournament_type,
            'tournament' => $tournament,
        ]);
    }
    function confirmEdit(Request $request)
    {
        $id = $request->input('id');
        $title = $request->input('title');
        $amount = $request->input('amount');
        $fee = $request->input('fee');
        $tournament_type = $request->input('tournament_type');
        $registered_users_limit = $request->input('registered_users_limit');

        $tournament=Tournament::where('id',$id)->first();
        Tournament::where('id',$id)->update([
            'title'=>$title,
            'amount'=>$amount,
            'fee'=>$fee,
            'tournament_type'=>$tournament_type,
            'registered_users_limit'=>$registered_users_limit,
        ]);

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
            $destinationPath = public_path('/assets/images/tournaments');
            $fileName = time() . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
            //delete old file from public
            File::delete($destinationPath."/".$tournament->image);

            //update datablase to new filename
            Tournament::where('id', $id)->update([
                'image' => $fileName,
            ]);
        }

        return redirect()->route('admin.tournament');
    }
    function deleteId(Request $request){
        Tournament::where('id',$request->input('id'))->delete();
        echo 'success';
    }
    function roomInfo($id)
    {
        $tournament = Tournament::where('id', $id)->first();
        return view('admin.tournament-room-info', ['tournament' => $tournament]);
    }
    function setRoomInfo(Request $request){
        $id=$request->input('id');
        $room_id=$request->input('room_id');
        $room_password=$request->input('room_password');
        Tournament::where('id',$id)->update([
            'room_id'=>$room_id,
            'room_password'=>$room_password,
        ]);
        return redirect()->route('admin.tournament');
    }
}
