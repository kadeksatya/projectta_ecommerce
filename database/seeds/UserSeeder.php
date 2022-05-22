<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(array(
           0 => [
                'name' => 'admin',
                'username' => 'admin',
                'email'=> 'admin@admin.com',
                'password'=> Hash::make('password'),
                'role_id' => '1'
            ],
            1 => [
                'name' => 'user',
                'username' => 'user',
                'email'=> 'user@user.com',
                'password'=> Hash::make('password'),
                'role_id' => '2'
            ],

        ));
    }
}
