<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_users')->insert([
            'id' => 1,
            'name' => 'Activo',
            'description' => 'Usuario activo y acceso permitido al sistema',
        ]);
        DB::table('status_users')->insert([
            'id' => 2,
            'name' => 'Inactivo',
        ]);
        DB::table('status_users')->insert([
            'id' => 3,
            'name' => 'Suspendido',
        ]);
        DB::table('status_users')->insert([
            'id' => 4,
            'name' => 'Bloqueado',
        ]);
    }
}