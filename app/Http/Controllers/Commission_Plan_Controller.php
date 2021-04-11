<?php

namespace App\Http\Controllers;

use App\User;
use App\Commission;
use App\Employee_Sales_Plan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Commission_Plan_Controller extends Controller
{
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

                    $user_commission = 0;
                    foreach ($commissions as $key3 => $commission) {

                        if($total_sales[$i] > $commission->sales_quota){
                            $user_commission = $total_sales[$i]* $commission->commission_percentage/100;
                            break;
                        }
                    }

                    array_push($users_commissions, [
                        'user_id'       =>  $value->user_id,
                        'user_name'     =>  $value->user_name,
                        'total_sales'   =>  $total_sales[$i],
                        'commission'    =>  $user_commission,
                    ]);
                    break;
                }
                $i++;
            }

        }

        return view('commission_plan',[
            'plan'                  =>  $plan,
            'users_commissions'     =>  $users_commissions,
            'commissions'           =>  $commissions,
            'to_be_approved'        =>  $to_be_approved,
            'approver'              =>  $approver,
            'role_of_approver'      =>  $role_of_approver,
        ]);
    }
}