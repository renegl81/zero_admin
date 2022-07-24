<?php

namespace Database\Seeders;

use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! User::where('email', 'admin@zero.com')->first()) {
            $user = new User();
            $user->name = 'admin';
            $user->email = 'admin@zero.com';
            $user->password = bcrypt('admin');

            $user->save();

            $roleUser = new RoleUser();
            $roleUser->user_id = $user->id;
            $roleUser->role_id = 2;

            $roleUser->save();
        }
    }
}
