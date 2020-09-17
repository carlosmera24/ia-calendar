<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateProgrammerMembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_programmers_memberships')->insert([
            'id' => 1,
            'name' => 'Activa',
            'description' => 'Membresía activa/vigente',
        ]);

        DB::table('status_programmers_memberships')->insert([
            'id' => 2,
            'name' => 'Cancelada',
            'description' => '',
        ]);

        DB::table('status_programmers_memberships')->insert([
            'id' => 3,
            'name' => 'Pendiente',
            'description' => 'Pendiente de pago',
        ]);

        DB::table('status_programmers_memberships')->insert([
            'id' => 4,
            'name' => 'Eliminada',
            'description' => 'Membresía eliminada',
        ]);

        DB::table('status_programmers_memberships')->insert([
            'id' => 5,
            'name' => 'Caducada',
            'description' => 'El tiempo de la membresía ha finalizado',
        ]);

        DB::table('status_programmers_memberships')->insert([
            'id' => 6,
            'name' => 'Suspendida',
        ]);

        DB::table('status_programmers_memberships')->insert([
            'id' => 7,
            'name' => 'Finalizada',
            'description' => 'La membresía ha finalizado su tiempo de suscripción',
        ]);
    }
}
