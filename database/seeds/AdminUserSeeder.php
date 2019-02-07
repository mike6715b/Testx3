<?php

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User;
        $user->user_name = "Administrator";
        $user->user_uid = "admin";
        $user->user_email = "admin@testx3.xyz";
        $user->user_pwd = \Illuminate\Support\Facades\Hash::make('z792nGYHSK');
        $user->user_class = "admin";
        $user->save();
    }
}
