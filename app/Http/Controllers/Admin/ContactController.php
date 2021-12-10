<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactedMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
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
        $contacted_messages = ContactedMessage::all();
        if (view()->exists($path)) {
            return view($path, [
                'contacted_messages' => $contacted_messages,
            ]);
        }

        return view('pages-404');
    }
    public function delete(Request $request)
    {
        $id = $request->input('id');
        ContactedMessage::whereId($id)->delete();
        return redirect()->route('admin.contact');
    }
}
