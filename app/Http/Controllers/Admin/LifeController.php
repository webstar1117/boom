<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Life;
use App\Models\Media;
use App\Models\Memorial;
use App\Models\Story;
use App\Models\Tribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;


class LifeController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        $this->media_file_path = '/assets/media';
    }
    public function index(Request $request)
    {
        if ($request->path()) {
            $ss = explode("/", $request->path());
            $path = $ss[0] . "." . $ss[1];
        }
        $lives = Life::all();
        if (view()->exists($path)) {
            return view($path, [
                'lives' => $lives,
            ]);
        }
        return view('pages-404');
    }
    public function delete(Request $request)
    {
        $id = $request->input('id');
        $life=Life::whereId($id)->first();

        $destinationPath = public_path($this->media_file_path);

        if(!Gallery::where('media_id', $life->media_id)->exists()){
            File::delete($destinationPath . "/" . $life->media->name);
            Media::where('name', $life->media->name)->delete();
        }
        
        Life::whereId($id)->delete();

        Session::flash('success', 'Deleted successful!');
        return back();
    }
}
