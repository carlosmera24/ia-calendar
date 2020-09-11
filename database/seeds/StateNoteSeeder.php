<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_notes')->insert([
            'id' => 1,
            'name' => 'Activo',
            'description' => 'Nota activa',
        ]);

        DB::table('status_notes')->insert([
            'id' => 2,
            'name' => 'Caducada',
            'description' => 'El tiempo de activación ha caducado',
        ]);
    }
}
