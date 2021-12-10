<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttackLimit;
use App\Models\BuyDiamondsLimit;
use App\Models\BuyDiamondsOrder;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class BuyDiamondsOrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function index(Request $request)
    {
        if (Session::get('lang')) {
            App::setLocale(Session::get('lang'));
        }
        if ($request->path()) {
            $ss = explode("/", $request->path());
            $path = $ss[0] . "." . $ss[1];
        }
        if (view()->exists($path)) {

            $all_buy_diamonds_orders = BuyDiamondsOrder::all();
            return view($path, ['all_buy_diamonds_orders' => $all_buy_diamonds_orders]);
        }
        return view('admin.pages-404');
    }
}
