<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ThemeCategory;
use Illuminate\Http\Request;


class ThemeCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index(Request $request){
        if ($request->path()) {
            $ss = explode("/", $request->path());
            $path = $ss[0] . "." . $ss[1];
        }
        $theme_categories=ThemeCategory::all();
        if (view()->exists($path)) {
            return view($path,[
                'theme_categories'=>$theme_categories
            ]);
        }

        return view('pages-404');
    }
    public function create(Request $request)
    {
        ThemeCategory::create([
            'name' => $request->input('category'),
        ]);
        return redirect()->route('admin.theme-category');
    }

    public function edit(Request $request)
    {
        $id = $request->input('id');
        ThemeCategory::whereId($id)->update([
            'name' => $request->input('category'),
        ]);
        return redirect()->route('admin.theme-category');
    }
}
