<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! Role::where('name', 'User')->first()) {
            //create User role
            $role = new Role();
            $role->name = 'User';
            $role->save();
        }
        if (! Role::where('name', 'Admin')->first()) {
            //create Admin role
            $role = new Role();
            $role->name = 'Admin';
            $role->save();
        }
    }
}
