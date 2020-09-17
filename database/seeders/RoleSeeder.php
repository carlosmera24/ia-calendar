<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'Administrador',
            'description' => 'Administrador del sistema',
        ]);

        DB::table('roles')->insert([
            'id' => 2,
            'name' => 'Participante',
            'description' => 'Participante del programador',
        ]);
    }
}
