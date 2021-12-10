<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use App\Models\ThemeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ThemeController extends Controller
{
    public function __construct()
    {
        $this->img_file_path = '/assets/images/themes/screenshot';
        $this->css_file_path = '/assets/css/themes';
        $this->middleware('admin');
    }
    public function index(Request $request)
    {
        if ($request->path()) {
            $ss = explode("/", $request->path());
            $path = $ss[0] . "." . $ss[1];
        }
        $theme_categories = ThemeCategory::all();
        $themes = Theme::all();
        if (view()->exists($path)) {
            return view($path, [
                'themes' => $themes,
                'theme_categories' => $theme_categories,
            ]);
        }

        return view('pages-404');
    }
    public function create(Request $request)
    {
        $theme = Theme::create([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
        ]);
        $theme_id = $theme->id;

        $img_file = $request->file('image');
        if ($img_file) {
            //File Name
            $img_file->getClientOriginalName();

            //Display File Extension
            $img_file->getClientOriginalExtension();

            //Display File Real Path
            $img_file->getRealPath();

            //Display File Size
            $img_file->getSize();

            //Display File Mime Type
            $img_file->getMimeType();
            //Move Uploaded File
            $destinationPath = public_path($this->img_file_path);
            $fileName = time() . $img_file->getClientOriginalName();
            $img_file->move($destinationPath, $fileName);

            //update datablase to new filename
            Theme::where('id', $theme_id)->update(['image' => $fileName]);
        }
        $css_file = $request->file('css_file');
        if ($css_file) {
            //File Name
            $css_file->getClientOriginalName();

            //Display File Extension
            $css_file->getClientOriginalExtension();

            //Display File Real Path
            $css_file->getRealPath();

            //Display File Size
            $css_file->getSize();

            //Display File Mime Type
            $css_file->getMimeType();
            //Move Uploaded File
            $destinationPath = public_path($this->css_file_path);
            $fileName = time() . $css_file->getClientOriginalName();
            $css_file->move($destinationPath, $fileName);

            //update datablase to new filename
            Theme::where('id', $theme_id)->update(['css_file' => $fileName]);
        }
        return redirect()->route('admin.theme');
    }

    public function edit(Request $request)
    {
        $id = $request->input('id');

        Theme::whereId($id)->update([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
        ]);
        //update image 
        $theme = Theme::where('id', $id)->first();
        $img_file = $request->file('image');
        if ($img_file) {
            //File Name
            $img_file->getClientOriginalName();

            //Display File Extension
            $img_file->getClientOriginalExtension();

            //Display File Real Path
            $img_file->getRealPath();

            //Display File Size
            $img_file->getSize();

            //Display File Mime Type
            $img_file->getMimeType();
            //Move Uploaded File
            $destinationPath = public_path($this->img_file_path);
            $fileName = time() . $img_file->getClientOriginalName();
            $img_file->move($destinationPath, $fileName);

            //delete old file from public
            File::delete($destinationPath . "/" . $theme->image);
            //update datablase to new filename
            Theme::where('id', $theme->id)->update(['image' => $fileName]);
        }
        $css_file = $request->file('css_file');
        if ($css_file) {
            //File Name
            $css_file->getClientOriginalName();

            //Display File Extension
            $css_file->getClientOriginalExtension();

            //Display File Real Path
            $css_file->getRealPath();

            //Display File Size
            $css_file->getSize();

            //Display File Mime Type
            $css_file->getMimeType();
            //Move Uploaded File
            $destinationPath = public_path($this->css_file_path);
            $fileName = time() . $css_file->getClientOriginalName();
            $css_file->move($destinationPath, $fileName);

            //delete old file from public
            File::delete($destinationPath . "/" . $theme->image);

            //update datablase to new filename
            Theme::where('id', $theme->id)->update(['css_file' => $fileName]);
        }
        return redirect()->route('admin.theme');
    }
}
