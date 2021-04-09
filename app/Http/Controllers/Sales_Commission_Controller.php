<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Sales_Commission_Controller extends Controller
{
    public function sales_commission_index ()
    {
        // $users      =   User::doesntHave('roles')->get();
        // $roles      =   Role::pluck('name');
        
        // $sales_comms = [];
        $sales_comms = [];


        return view('sales_commission',[
            'sales_comms'         => $sales_comms,
            // 'users'         => $users,
            // 'roles'         => $roles,
        ]);
    }

    public function assign_roles_store ($user_id, $role = null)
    {
        if(is_null($role)){
            return redirect()->back()->with('error', "Please select a role first.");
        }
        else {
            User::find($user_id)->assignRole($role);
        }

        // Return
        return redirect()->back()->with('success', "{$role} role assigned.");
    }

    // public function assign_roles_redirect ($user_id)
    // {
    //     return redirect()->back()->with('error', "Please select a role first.");
    // }

}
