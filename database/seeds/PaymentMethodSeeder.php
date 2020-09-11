<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->insert([
            'id' => 1,
            'name' => 'Tarjeta de Crédito',
            'description' => 'Pago con tarjeta de crédito',
        ]);

        DB::table('payment_methods')->insert([
            'id' => 2,
            'name' => 'Tarjeta débito',
            'description' => 'Pago con tarjeta débito',
        ]);

        DB::table('payment_methods')->insert([
            'id' => 3,
            'name' => 'PSE'
        ]);
    }
}
