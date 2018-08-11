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
        $user->email = config('app.system_admin_email');
        $user->password = bcrypt(config('app.system_admin_password'));
        $user->role = USER_ROLE_ADMIN;
        $user->status = USER_STATUS_ACTIVE;
        $user->creation_type = USER_CREATION_TYPE_IMPORT;
        $user->save();
    }
}
