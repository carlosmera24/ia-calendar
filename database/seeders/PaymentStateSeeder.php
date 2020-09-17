<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_status')->insert([
            'id' => 1,
            'name' => 'Creado',
            'description' => 'Registro del pago de manera inicial',
        ]);

        DB::table('payment_status')->insert([
            'id' => 2,
            'name' => 'Pendiente',
            'description' => 'Se realizó el pago pero está pendiente de aprobación por entidad bancaria',
            ]);

        DB::table('payment_status')->insert([
            'id' => 3,
            'name' => 'Aprobado',
            'description' => 'El pago se realizó'
        ]);

        DB::table('payment_status')->insert([
            'id' => 4,
            'name' => 'Rechazado',
            'description' => 'El pago fue rechazado por la entidad bancaria'
        ]);

        DB::table('payment_status')->insert([
            'id' => 5,
            'name' => 'Cancelado',
            'description' => 'Pago cancelado o eliminado'
        ]);
    }
}
