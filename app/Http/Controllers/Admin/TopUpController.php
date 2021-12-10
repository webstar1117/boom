<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TopUp;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class TopUpController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        if (Session::get('lang')) {
            App::setLocale(Session::get('lang'));
        }
        if ($request->path()) {
            $ss = explode("/", $request->path());
            $path = $ss[0] . "." . $ss[1];
        }
        if (view()->exists($path)) {
            $all_top_up = TopUp::all();
            return view($path, ['all_top_up' => $all_top_up]);
        }
        return view('pages-404');
    }

    public function edit($id)
    {
        $top_up = TopUp::where('top_up_id', $id)->first();
        return view('admin.top-up-edit', ['top_up' => $top_up]);
    }

    public function confirmEdit(Request $request)
    {

        $id = $request->input('id');
        $title = $request->input('title');
        $actual_amount = $request->input('actual_amount');
        $offer_amount = $request->input('offer_amount');
        $top_up = TopUp::where('top_up_id', $id)->first();
        TopUp::where('top_up_id', $id)->update([
            'top_up_title' => $title,
            'top_up_actual_amount' => $actual_amount,
            'top_up_offer_amount' => $offer_amount,
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
            $destinationPath = public_path('/assets/images/top-ups');
            $fileName = time() . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);



            //delete old file from public
            File::delete($destinationPath . "/" . $top_up->top_up_image);

            //update datablase to new filename
            TopUp::where('top_up_id', $id)->update(['top_up_image' => $fileName]);
        }

        return redirect()->route('admin.top-up');
    }
    public function stock(Request $request)
    {
        $id = $request->input('id');
        $stock = $request->input('stock');
        if ($stock == 0)
            TopUp::where('top_up_id', $id)->update(['top_up_out_of_stock' => 1]);
        else if ($stock == 1) {
            TopUp::where('top_up_id', $id)->update(['top_up_out_of_stock' => 0]);
        }
        echo 'success';
    }
    public function delete(Request $request)
    {
        $id = $request->input('id');
        TopUp::where('top_up_id', $id)->delete();
        echo 'success';
    }

    public function confirmAdd(Request $request)
    {
        $diamond = $request->input('diamond');
        $first_bonus = $request->input('first_bonus');
        $actual_amount = $request->input('actual_amount');
        $title = $request->input('title');

        $offer_amount = $request->input('offer_amount');
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
            $destinationPath = public_path('/assets/images/top-ups');
            $fileName = time() . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);

            //insert datablase to new filename
            TopUp::insert(
                [
                    'top_up_diamond' => $diamond,
                    'top_up_first_bonus' => $first_bonus,
                    'top_up_title' => $title,
                    'top_up_actual_amount' => $actual_amount,
                    'top_up_offer_amount' => $offer_amount,
                    'top_up_out_of_stock' => 1,
                    'top_up_image' => $fileName
                ]
            );
        }
        return redirect()->route('admin.top-up');
    }
}
