<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_participants')->insert([
            'id' => 1,
            'name' => 'Activo',
            'description' => 'Partícipe activo',
        ]);
        DB::table('status_participants')->insert([
            'id' => 2,
            'name' => 'Inactivo',
            'description' => 'Partícipe inhabilitado',
        ]);
        DB::table('status_participants')->insert([
            'id' => 3,
            'name' => 'Bloqueado',
            'description' => 'Partícipe bloqueado',
        ]);
        DB::table('status_participants')->insert([
            'id' => 4,
            'name' => 'Suspendido',
        ]);
    }
}
