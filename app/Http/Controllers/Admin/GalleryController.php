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


class GalleryController extends Controller
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
        $galleries = Gallery::all();
        if (view()->exists($path)) {
            return view($path, [
                'galleries' => $galleries,
            ]);
        }
        return view('pages-404');
    }
    public function delete(Request $request)
    {
        $id = $request->input('id');
        $gallery=Gallery::whereId($id)->first();

        $destinationPath = public_path($this->media_file_path);

        if(!Life::where('media_id', $gallery->media_id)->exists() 
        && !Story::where('media_id', $gallery->media_id)->exists()){
            File::delete($destinationPath . "/" . $gallery->media->name);
            Media::where('name', $gallery->media->name)->delete();
        }
        
        Gallery::whereId($id)->delete();

        Session::flash('success', 'Deleted successful!');
        return back();
    }
}
