<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatePasswordChangeRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_password_change_requests')->insert([
            'id' => 1,
            'name' => 'Activo',
        ]);
        DB::table('status_password_change_requests')->insert([
            'id' => 2,
            'name' => 'Expirado',
        ]);
        DB::table('status_password_change_requests')->insert([
            'id' => 3,
            'name' => 'Finalizado',
        ]);
    }
}
