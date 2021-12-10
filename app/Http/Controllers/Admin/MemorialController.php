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


class MemorialController extends Controller
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
        $memorials = Memorial::all();
        if (view()->exists($path)) {
            return view($path, [
                'memorials' => $memorials,
            ]);
        }
        return view('pages-404');
    }
    public function delete(Request $request)
    {
        $id = $request->input('id');
        $life_media_ids = Life::where('memorial_id', $id)->get();
        $stories_media_ids = Story::where('memorial_id', $id)->get();
        $gallery_media_ids = Gallery::where('memorial_id', $id)->get();

        $destinationPath = public_path($this->media_file_path);

        foreach ($life_media_ids as $item) {
            File::delete($destinationPath . "/" . $item->media->name);
            Media::whereId($item->media_id)->delete();
        }
        foreach ($stories_media_ids as $item) {
            File::delete($destinationPath . "/" . $item->media->name);
            Media::whereId($item->media_id)->delete();
        }
        foreach ($gallery_media_ids as $item) {
            File::delete($destinationPath . "/" . $item->media->name);
            Media::whereId($item->media_id)->delete();
        }

        Memorial::where('memorial_id', $id)->delete();

        Tribute::where('memorial_id', $id)->delete();
        Life::where('memorial_id', $id)->delete();
        Story::where('memorial_id', $id)->delete();
        Gallery::where('memorial_id', $id)->delete();

        Session::flash('success', 'Deleted successful!');
        return back();
    }
}
