<?php

namespace Database\Seeders;

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
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Usuario Demo',
            'user' => 'demo-iacalendar',
            'password' => Hash::make('abcd1234'),
            'roles_id' => 1,
            'status_users_id' => 1
        ]);
    }
}
