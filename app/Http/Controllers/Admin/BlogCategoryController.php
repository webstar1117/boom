<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * show dashboard.
     *
     * @return Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if ($request->path()) {
            $ss = explode("/", $request->path());
            $path = $ss[0] . "." . $ss[1];
        }
        $blog_categories = BlogCategory::all();
        if (view()->exists($path)) {
            return view($path, [
                'blog_categories' => $blog_categories,
            ]);
        }

        return view('pages-404');
    }
    public function create(Request $request)
    {
        BlogCategory::create([
            'name' => $request->input('category'),
        ]);
        return redirect()->route('admin.blog-category');
    }

    public function edit(Request $request)
    {
        $id = $request->input('id');
        BlogCategory::whereId($id)->update([
            'name' => $request->input('category'),
        ]);
        return redirect()->route('admin.blog-category');
    }

}
