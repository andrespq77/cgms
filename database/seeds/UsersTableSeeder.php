<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = new User();
        $user->name = 'Admin';
        $user->email = env('SYSTEM_ADMIN_EMAIL');
        $user->password = bcrypt(env('SYSTEM_ADMIN_PASSWORD'));
        $user->role = USER_ROLE_ADMIN;
        $user->status = USER_STATUS_ACTIVE;
        $user->creation_type = USER_CREATION_TYPE_IMPORT;
        $user->save();
    }
}
