<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Auth;
class CommentController extends Controller
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
        $blogs = Blog::all(); 
        $comments = Comment::all(); 
        if (view()->exists($path)) {
            return view($path, [
                'blogs' => $blogs,
                'comments' => $comments,
            ]);
        }

        return view('pages-404');
    }
    public function create(Request $request)
    {
        Comment::create([
            'user_id' =>Auth::id(),
            'blog_id' => $request->input('blog_id'),
            'content' => $request->input('content'),
        ]);
        return redirect()->route('admin.comment');
    }

    public function edit(Request $request)
    {
        $id = $request->input('id');
        Comment::whereId($id)->update([
            'content' => $request->input('content'),
        ]);
        return redirect()->route('admin.comment');
    }
    public function delete(Request $request)
    {
        $id = $request->input('id');
        Comment::whereId($id)->delete();
        return redirect()->route('admin.comment');
    }
}
