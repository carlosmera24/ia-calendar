<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IdentificationTypeTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('identifications_types_translations')->insert([
            'id' => 1,
            'identifications_types_id' => 1,
            'language' => 'es',
            'name' => 'Registro Civil',
        ]);
        DB::table('identifications_types_translations')->insert([
            'id' => 2,
            'identifications_types_id' => 2,
            'language' => 'es',
            'name' => 'Tarjeta de Identidad',
        ]);
        DB::table('identifications_types_translations')->insert([
            'id' => 3,
            'identifications_types_id' => 3,
            'language' => 'es',
            'name' => 'Cédula de ciudadanía',
        ]);
        DB::table('identifications_types_translations')->insert([
            'id' => 4,
            'identifications_types_id' => 4,
            'language' => 'es',
            'name' => 'Cédula de extranjería',
        ]);
        DB::table('identifications_types_translations')->insert([
            'id' => 5,
            'identifications_types_id' => 5,
            'language' => 'es',
            'name' => 'Pasaporte',
        ]);
        DB::table('identifications_types_translations')->insert([
            'id' => 6,
            'identifications_types_id' => 6,
            'language' => 'es',
            'name' => 'Menor sin identificación',
        ]);
        DB::table('identifications_types_translations')->insert([
            'id' => 7,
            'identifications_types_id' => 7,
            'language' => 'es',
            'name' => 'Adulto sin identificación',
        ]);
        DB::table('identifications_types_translations')->insert([
            'id' => 8,
            'identifications_types_id' => 8,
            'language' => 'es',
            'name' => 'Número de Identificación Tributaria',
        ]);
    }
}
