<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class Admin_Controller extends Controller
{
    public function assign_roles_index ()
    {
        $users      =   User::doesntHave('roles')->get();
        $roles      =   Role::pluck('name');
        
        return view('assign_roles',[
            'users'         => $users,
            'roles'         => $roles,
        ]);
    }

    public function assign_roles_store ($user_id, $role)
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
