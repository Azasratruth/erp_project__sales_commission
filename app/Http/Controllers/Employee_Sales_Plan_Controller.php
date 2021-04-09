<?php

namespace App\Http\Controllers;

use App\User;
use App\Commission;

use App\Employee_Sales_Plan;
use Illuminate\Http\Request;

class Employee_Sales_Plan_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // $plan = Employee_Sales_Plan::where('approved', 1)->latest()->first();
        $plan = Employee_Sales_Plan::latest()->first();

        if(is_null($plan)){
            return redirect()->back()->with('info', 'No employee sales plan available.');
        }

        $approver = User::find($plan->approved_by_id);
        $role_of_approver = $approver->getRoleNames()[0];

        $to_be_approved = FALSE;
        
        if(strcmp($role_of_approver, "manager") == 0 || strcmp($role_of_approver, "ceo") == 0) {
            $to_be_approved = TRUE;
        }    
        
        $commissions = [];
        if(!is_null($plan)) {
            $commissions = Commission::where('employee_sales_plan_id', $plan->id)->get();
        }

        return view('employee_sales_plan',[
            'plan'                  =>  $plan,
            'commissions'           =>  $commissions,
            'to_be_approved'        =>  $to_be_approved,
            'approver'              =>  $approver,
            'role_of_approver'      =>  $role_of_approver,
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
    public function store($id, $approval)
    {
        $plan = Employee_Sales_Plan::find($id);
        $plan->approved         = $approval;
        $plan->approved_by_id   = request()->user()->id;
        $plan->save();

        if($approval){
            // 1
            return redirect()->back()->with('success', 'Plan approved.');
        }
        else{
            // 0
            return redirect()->back()->with('success', 'Plan rejected.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee_Sales_Plan  $employee_Sales_Plan
     * @return \Illuminate\Http\Response
     */
    public function show(Employee_Sales_Plan $employee_Sales_Plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee_Sales_Plan  $employee_Sales_Plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee_Sales_Plan $employee_Sales_Plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee_Sales_Plan  $employee_Sales_Plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee_Sales_Plan $employee_Sales_Plan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee_Sales_Plan  $employee_Sales_Plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee_Sales_Plan $employee_Sales_Plan)
    {
        //
    }
}
