<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\InrDepositOrder;
use App\Models\Tournament;
use App\Models\TournamentRegister;
use App\Models\TournamentType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Auth;

class TournamentRegisterController extends Controller
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
            $all_tournament_registers=TournamentRegister::all();
            return view($path, ['all_tournament_registers' => $all_tournament_registers]);
        }
        return view('pages-404');
    }
    function edit($id){
        $tournament_register=TournamentRegister::where('id',$id)->first();
        $tournament=Tournament::where('id',$tournament_register->tournament_id)->first();
        $all_tournament_type = TournamentType::all();

        return view('admin.tournament-register-edit',[
            'tournament_register'=>$tournament_register,
            'tournament'=>$tournament,
            'all_tournament_type'=>$all_tournament_type,
            ]);
    }
    function pay($id){
        $tournament_register=TournamentRegister::where('id',$id)->first();
        $tournament=Tournament::where('id',$tournament_register->tournament_id)->first();
        return view('admin.tournament-register-pay',[
            'tournament'=>$tournament,
            ]);
    }
    function confirmPay(Request $request){
        $username=$request->input('username');
        $amount=$request->input('amount');
        $user= User::where('name',$username)->first();

        User::where('id',$user->id)->increment('inr',$amount);

        $inr_deposit_order = new InrDepositOrder();

        $inr_deposit_order->user_id = $user->id;
        $inr_deposit_order->order_amount = $amount;
        $inr_deposit_order->order_currency = 'INR';
        $inr_deposit_order->customer_name = $user->name;
        $inr_deposit_order->customer_phone = $user->phone_number;
        $inr_deposit_order->customer_email = $user->email;
        $inr_deposit_order->details = 'admin';
        $inr_deposit_order->status = 'paid';

        $inr_deposit_order->save();

        echo "success";
    }
}
