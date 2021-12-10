<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteChat;
use App\Models\WithdrawFee;
use App\Models\WithdrawLimit;
use App\Models\WithdrawStatus;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class WithdrawLimitController extends Controller
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
            $all_withdraw_limit = WithdrawLimit::all();
            $withdraw_fee = WithdrawFee::all()[0];
            $withdraw_status=WithdrawStatus::all()[0];
            // $site_chat = SiteChat::all()[0];
            return view($path, [
                'all_withdraw_limit' => $all_withdraw_limit,
                'withdraw_fee' => $withdraw_fee,
                'withdraw_status' => $withdraw_status,
            ]);
        }
        return view('pages-404');
    }

    function edit(Request $request)
    {
        if($request->input('site_switch')=='on'){
            WithdrawStatus::where('withdraw_status_id',$request->input('status_id'))
            ->update(['withdraw_status_status'=>1]);
        }else{
            WithdrawStatus::where('withdraw_status_id',$request->input('status_id'))
            ->update(['withdraw_status_status'=>0]);
        }
        if ($request->input('fee') == null)
            return redirect()->back()->with('no-data', 'There is no fee!');
        WithdrawFee::where('withdraw_fee_id', $request->input('fee_id'))->update(['withdraw_fee_amount' => $request->input('fee')]);

        DB::table('withdraw_limits')->delete();
        if ($request->input('withdraw_amount') == null)
            return redirect()->back()->with('no-data', 'There is no data!');
        foreach ($request->input('withdraw_amount') as $key => $withdraw_amount) {
            WithdrawLimit::insert([
                'withdraw_limit_amount' => $withdraw_amount,
            ]);
        }
        return redirect()->route('admin.withdraw-limit');
    }

    public function confirmEdit(Request $request)
    {
        $id = $request->input('id');
        $fee = $request->input('fee');
        $min = $request->input('min');
        $max = $request->input('max');
        if ($request->input('switch') == 'on') {
            $option = 'enabled';
        } else {
            $option = 'disabled';
        }

        WithdrawLimit::where('withdraw_limit_id', $id)->update([
            'withdraw_limit_fee' => $fee,
            'withdraw_limit_min' => $min,
            'withdraw_limit_max' => $max,
            'withdraw_limit_option' => $option,
        ]);
        return redirect()->route('admin.withdraw-limit');
    }
}
