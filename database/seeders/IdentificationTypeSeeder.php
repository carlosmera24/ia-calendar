<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IdentificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('identifications_types')->insert([
            'id' => 1,
            'abrevation' => 'RC',
        ]);
        DB::table('identifications_types')->insert([
            'id' => 2,
            'abrevation' => 'TI',
        ]);
        DB::table('identifications_types')->insert([
            'id' => 3,
            'abrevation' => 'CC',
        ]);
        DB::table('identifications_types')->insert([
            'id' => 4,
            'abrevation' => 'CE',
        ]);
        DB::table('identifications_types')->insert([
            'id' => 5,
            'abrevation' => 'PA',
        ]);
        DB::table('identifications_types')->insert([
            'id' => 6,
            'abrevation' => 'MS',
        ]);
        DB::table('identifications_types')->insert([
            'id' => 7,
            'abrevation' => 'AS',
        ]);
        DB::table('identifications_types')->insert([
            'id' => 8,
            'abrevation' => 'NIT',
        ]);
    }
}
