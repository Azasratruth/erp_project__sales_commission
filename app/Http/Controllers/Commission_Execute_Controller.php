<?php

namespace App\Http\Controllers;

use Mail;
use App\User;
use App\Commission;
use App\Employee_Sales_Plan;

use App\Commission_Execute;

use App\Mail\SalesCommissionConfirmation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Commission_Execute_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plan = Employee_Sales_Plan::latest()->first();

        if(is_null($plan)){
            return redirect()->back()->with('info', 'No employee sales plan available.');
        }

        if(is_null($plan->approved)){
            return redirect()->back()->with('info', 'New Employee Plan is being drafted.');
        }

        $approver = User::find($plan->approved_by_id);
        $role_of_approver = $approver->getRoleNames()[0];

        $to_be_approved = FALSE;
        
        if(strcmp($role_of_approver, "ceo") == 0 || strcmp($role_of_approver, "sales_manager") == 0) {
            $to_be_approved = TRUE;
        }    
        
        $commissions = [];
        $users = [];
        if(!is_null($plan)) {
            
            // Commissions
            $commissions = Commission::where('employee_sales_plan_id', $plan->id)
            ->orderBy('sales_quota', 'desc')
            ->get();

            // User Data
            $users = DB::table('users')
            ->join('sale', 'sale.seller_id', '=', 'users.id')
            ->join('product', 'product.id', '=', 'sale.product_id')
            ->select('*', 'users.name as user_name', 'users.id as user_id')
            ->get();

            $users = $users->groupby('seller_id');

            // Total Sales of User
            $total_sales = [];
            foreach ($users as $key => $user) {
                $sum = 0;
                foreach ($user as $key2 => $value) {
                    $sum += $value->cost * $value->quantity;
                }
                array_push($total_sales, $sum);
            }

            $users_commissions = [];
    
            $i = 0;
            foreach ($users as $key1 => $user) {
                foreach ($user as $key2 => $value) {

                    $commission_id = -1;
                    $user_commission = 0;
                    foreach ($commissions as $key3 => $commission) {

                        if($total_sales[$i] > $commission->sales_quota){
                            $commission_id = $commission->id;
                            $user_commission = $total_sales[$i] * $commission->commission_percentage/100;
                            break;
                        }
                    }

                    if($commission_id != -1){
                        
                        $user_executed_check    =   DB::table('commission_execute')
                        ->join('commission', 'commission.id', 'commission_id')
                        ->where('commission.employee_sales_plan_id', $plan->id)
                        ->exists('commission_execute.seller_id', $value->user_id);

                        if(!$user_executed_check){
                            array_push($users_commissions, [
                                'user_id'           =>  $value->user_id,
                                'user_name'         =>  $value->user_name,
                                'total_sales'       =>  $total_sales[$i],
                                'commission_id'     =>  $commission_id,
                                'commission'        =>  $user_commission,
                            ]);
                        }
                    }
                    
                    break;
                }
                $i++;
            }

        }

        return view('commission_execute',[
            'plan'                  =>  $plan,
            'users_commissions'     =>  $users_commissions,
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
    public function store($plan_id, $plan_executed, $user_id, $commission_id, $commission_amount, $approved)
    {
        Commission_Execute::create([
            'seller_id'         =>  $user_id,
            'commission_id'     =>  $commission_id,
            'commission_amount' =>  $commission_amount,
            
            'added_by_id'       =>  request()->user()->id,

            'approved'          =>  $approved,
            'approved_by_id'    =>  request()->user()->id,
            
            'executed'          =>  $approved,
            'executed_by_id'    =>  request()->user()->id,
        ]);

        if($plan_executed == 1){
            $plan = Employee_Sales_Plan::find($plan_id);
            $plan->executed         = 1;
            $plan->executed_by_id   = request()->user()->id;
            $plan->save();
        }

        if($approved == 1){
            $to_name = User::find($user_id)->name;
            $to_email = trim(User::find($user_id)->email);
            $data = array('name'=> User::find($user_id)->name, 'body' => "Sales Commission Rs. {$commission_amount} added to account.");
            
            $template = new SalesCommissionConfirmation(request()->user()->name, request()->user()->email, User::find($user_id), $commission_amount);
            Mail::to($to_email)->send($template);

            return redirect()->back()->with('success', "Commission Approved. Email Sent.");
        }
        else{
            return redirect()->back()->with('success', "Commission Rejected.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Commission_Execute  $commission_Execute
     * @return \Illuminate\Http\Response
     */
    public function show(Commission_Execute $commission_Execute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Commission_Execute  $commission_Execute
     * @return \Illuminate\Http\Response
     */
    public function edit(Commission_Execute $commission_Execute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Commission_Execute  $commission_Execute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commission_Execute $commission_Execute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Commission_Execute  $commission_Execute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commission_Execute $commission_Execute)
    {
        //
    }
}
