<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles_participants')->insert([
            'id' => 1,
            'name' => 'Administrador',
            'description' => 'Administrador del programador',
        ]);

        DB::table('profiles_participants')->insert([
            'id' => 2,
            'name' => 'Líder',
            'description' => 'Líder del programador',
        ]);

        DB::table('profiles_participants')->insert([
            'id' => 3,
            'name' => 'Invitado',
            'description' => 'Invitado del programador',
        ]);
    }
}
