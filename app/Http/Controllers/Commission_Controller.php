<?php

namespace App\Http\Controllers;
use App\Employee_Sales_Plan;

use App\Commission;
use Illuminate\Http\Request;

class Commission_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plan = Employee_Sales_Plan::latest()->first();

        $commissions = [];
        $approved_by = null;
        if(!is_null($plan) && (is_null($plan->approved) || is_null($plan->executed))){
            $commissions = Commission::where('employee_sales_plan_id', $plan->id)->get();
        }

        // var_dump($plans);return;

        return view('commission',[
            'commissions'       => $commissions,
            'plan'              => $plan,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $plan = Employee_Sales_Plan::latest()->first();

        $commissions = [];

        if(is_null($plan) || (!is_null($plan->approved) && !is_null($plan->executed))){
        // New plan

            $plan = Employee_Sales_Plan::create([
                'added_by_id'   =>  request()->user()->id,
                'quarter'       =>  ceil(date("n") / 3),
            ]);
            
            Commission::create([
                'employee_sales_plan_id'    =>  $plan->id,
                'sales_quota'               =>  $request->sales_amount,
                'commission_percentage'     =>  $request->percentage,
            ]);

        }
        else{
        // Old plan

            Commission::create([
                'employee_sales_plan_id'    =>  $plan->id,
                'sales_quota'               =>  $request->sales_amount,
                'commission_percentage'     =>  $request->percentage,
            ]);
        }

        return redirect()->back()->with('success', 'Commission added to the plan.');
    }

    public function approve($id)
    {
        $plan = Employee_Sales_Plan::find($id);
        $plan->approved         = 1;
        $plan->approved_by_id   = request()->user()->id;
        $plan->save();


        return redirect()->back()->with('success', 'Plan Approved.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function show(Commission $commission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function edit(Commission $commission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commission $commission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Commission::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Commission removed from the plan.');
    }
}
