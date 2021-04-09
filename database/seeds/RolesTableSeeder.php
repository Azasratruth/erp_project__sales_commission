<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'ceo']);
        Role::create(['name' => 'manager']);
        Role::create(['name' => 'payables_manager']);
        Role::create(['name' => 'sales_manager']);
        Role::create(['name' => 'sales_person']);
    }
}
