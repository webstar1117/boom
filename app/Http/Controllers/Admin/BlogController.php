<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

use Auth;


class BlogController extends Controller
{
    private $img_file_path;
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
        $this->img_file_path='/assets/images/blogs';

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
        $blog_categories = BlogCategory::all();
        if (view()->exists($path)) {
            return view($path, [
                'blogs' => $blogs,
                'blog_categories' => $blog_categories,
            ]);
        }

        return view('pages-404');
    }
    public function create(Request $request)
    {
       $blog= Blog::create([
            'user_id' =>Auth::id(),
            'title' => $request->input('title'),
            'subtitle' => $request->input('subtitle'),
            'content' => $request->input('content'),
            'category' => $request->input('category'),
        ]);
        $blog_id=$blog->id;

        $file = $request->file('image');
        if($file){
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
            $destinationPath = public_path($this->img_file_path);
            $fileName=time().$file->getClientOriginalName();
            $file->move($destinationPath,$fileName);

            //update datablase to new filename
            Blog::where('id',$blog_id)->update(['image'=>$fileName]);
           
        }
        return redirect()->route('admin.blog');
    }

    public function edit(Request $request)
    {
        $id = $request->input('id');
        Blog::whereId($id)->update([
            'title' => $request->input('title'),
            'subtitle' => $request->input('subtitle'),
            'content' => $request->input('content'),
            'category' => $request->input('category'),
        ]);

        //update image 
        $blog=Blog::where('id',$id)->first();

        $file = $request->file('image');
        if($file){
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
            $destinationPath = public_path($this->img_file_path);
            $fileName=time().$file->getClientOriginalName();
            $file->move($destinationPath,$fileName);

           

            //delete old file from public
            File::delete($destinationPath."/".$blog->image);

            //update datablase to new filename
            Blog::where('id',$id)->update(['image'=>$fileName]);
           
        }
        return redirect()->route('admin.blog');
    }
    public function delete(Request $request)
    {
        $id = $request->input('id');
        $blog=Blog::whereId($id)->first();

        $destinationPath = public_path($this->img_file_path);
 
        //delete image file in public folder
        File::delete($destinationPath."/".$blog->image);

        Blog::whereId($id)->delete();
        Comment::where('blog_id',$id)->delete();

        return redirect()->route('admin.blog');
    }
}
