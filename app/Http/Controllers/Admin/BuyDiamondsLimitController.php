<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttackLimit;
use App\Models\BuyDiamondsLimit;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class BuyDiamondsLimitController extends Controller
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

            $all_buy_diamonds_limit = BuyDiamondsLimit::all();
            return view($path, ['all_buy_diamonds_limit' => $all_buy_diamonds_limit]);
        }
        return view('admin.pages-404');
    }
    function edit(Request $request)
    {
        DB::table('buy_diamonds_limits')->delete();

        if ($request->input('inr_amount') == null)
            return redirect()->back()->with('no-data', 'There is no data!');
        foreach ($request->input('inr_amount') as $key => $inr_amount) {
            BuyDiamondsLimit::insert([
                'buy_diamonds_limit_inr_amount' => $inr_amount,
                'buy_diamonds_limit_diamonds_amount' => $request->input('diamonds_amount')[$key],
            ]);
        }
        return redirect()->route('admin.buy-diamonds-limit');
    }
}
