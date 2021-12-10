<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Media;
use App\Models\Memorial;
use App\Models\Story;
use App\Models\Tribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;


class StoriesController extends Controller
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
        $stories = Story::all();
        if (view()->exists($path)) {
            return view($path, [
                'stories' => $stories,
            ]);
        }
        return view('pages-404');
    }
    public function delete(Request $request)
    {
        $id = $request->input('id');
        $story=Story::whereId($id)->first();

        $destinationPath = public_path($this->media_file_path);

        if(!Gallery::where('media_id', $story->media_id)->exists()){
            File::delete($destinationPath . "/" . $story->media->name);
            Media::where('name', $story->media->name)->delete();
        }
        
        Story::whereId($id)->delete();

        Session::flash('success', 'Deleted successful!');
        return back();
    }
}
