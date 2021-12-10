<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index(Request $request)
    {
        if ($request->path()) {
            $ss = explode("/", $request->path());
            $path = $ss[0] . "." . $ss[1];
        }
        $plans = Plan::all();
        if (view()->exists($path)) {
            return view($path, [
                'plans' => $plans,
            ]);
        }

        return view('pages-404');
    }
    public function getOne(Request $request)
    {
        $id = $request->input('id');
        $plan = Plan::whereId($id)->first();
        echo json_encode($plan);
    }
    public function deleteContent(Request $request)
    {
        $idx = $request->input('idx');
        $id = $request->input('id');
        $plan_contents = json_decode(Plan::whereId($id)->first()->contents);
        array_splice($plan_contents, $idx, 1);

        $plan = Plan::whereId($id)->update(['contents' => json_encode($plan_contents)]);
        
        $updated_plan = Plan::whereId($id)->first();
        echo json_encode($updated_plan);
        
    }
    public function edit(Request $request)
    {
        $id = $request->input('id');

        Plan::whereId($id)->update([
            'name'=>$request->input('name'),
            'price'=>$request->input('price'),
            'price_description'=>$request->input('price_description'),
            'plan_description'=>$request->input('plan_description'),
            'contents'=>json_encode($request->input('contents')),
        ]);
        return redirect()->route('admin.plan');
    }
}
