<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatePersonEmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_persons_emails')->insert([
            'id' => 1,
            'name' => 'activo',
            'description' => 'Email activo para uso',
        ]);
        DB::table('status_persons_emails')->insert([
            'id' => 2,
            'name' => 'pendiente',
            'description' => 'Email pediente de confirmación',
        ]);
        DB::table('status_persons_emails')->insert([
            'id' => 3,
            'name' => 'confirmando',
            'description' => 'Email enviado correo de verificación',
        ]);
        DB::table('status_persons_emails')->insert([
            'id' => 4,
            'name' => 'inactivo',
        ]);
    }
}
