<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Clean data demo
        DB::statement('DELETE FROM permissions_participants WHERE id > 0');
        DB::statement('ALTER TABLE permissions_participants AUTO_INCREMENT = 0');
        DB::statement('DELETE FROM participants_categories WHERE id > 0');
        DB::statement('ALTER TABLE participants_categories AUTO_INCREMENT = 0');
        DB::statement('DELETE FROM categories WHERE id > 0');
        DB::statement('ALTER TABLE categories AUTO_INCREMENT = 0');
        DB::statement('DELETE FROM colors WHERE id > 0');
        DB::statement('ALTER TABLE colors AUTO_INCREMENT = 0');
        DB::statement('DELETE FROM participants WHERE id > 0');
        DB::statement('ALTER TABLE participants AUTO_INCREMENT = 0');
        DB::statement('DELETE FROM persons_emails WHERE id > 0');
        DB::statement('ALTER TABLE persons_emails AUTO_INCREMENT = 0');
        DB::statement('DELETE FROM persons_cellphones WHERE id > 0');
        DB::statement('ALTER TABLE persons_cellphones AUTO_INCREMENT = 0');
        DB::statement('DELETE FROM persons WHERE id > 0');
        DB::statement('ALTER TABLE persons AUTO_INCREMENT = 0');
        DB::statement('DELETE FROM users WHERE id > 0');
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 0');
        DB::statement('DELETE FROM programmers WHERE id > 0');
        DB::statement('ALTER TABLE programmers AUTO_INCREMENT = 0');

        /**
         * Insert data
         */
        //Programmer
        DB::table('programmers')->insert([
            'id' => 1,
            'entity_name' => "Demo IA Calendar's",
            'identifications_types_id' => 8,
            'activated_birthday' => 1,
            'identification' => '23112020-1',
            'activated_birthday' => 1,
            'activated_date_join_company' => 1,
            'activated_tax_calendar' => 1,
            'activated_car_tax' => 1,
            'activated_ss_tax' => 1,
        ]);

        //User
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Usuario Demo',
            'user' => 'demo-iacalendar',
            'password' => Hash::make('abcd1234'),
            'roles_id' => 1,
            'status_users_id' => 1
        ]);

        //Person
        DB::table('persons')->insert([
            'id' => 1,
            'first_name' => 'Persona',
            'last_name' => 'Demo',
            'birth_date' => '1980-01-01',
            'position_company' => 'Demo del app',
            'date_join_company' => '2020-11-20',

        ]);

        //Participant
        DB::table('participants')->insert([
            'id' => 1,
            'persons_id' => 1,
            'programmers_id' => 1,
            'users_id' => 1,
            'profiles_participants_id' => 1,
            'description' => "Participante inicial administrador para el manejo de demostración y creación del app.",
        ]);

        //Colors
        DB::table('colors')->insert([
            [
                'id' => 1,
                'name' => 'gris',
                'description' => 'Color gris base para pruebas',
                'color' => '#CCCCCC',
            ],
            [
                'id' => 2,
                'name' => 'rojo',
                'description' => 'Color rojo base para pruebas',
                'color' => '#FF0000',
            ],
            [
                'id' => 3,
                'name' => 'azul',
                'description' => 'Color azul base para pruebas',
                'color' => '#000FFF',
            ],
            [
                'id' => 4,
                'name' => 'negro',
                'description' => 'Color negro base para pruebas',
                'color' => '#000000',
            ]

        ]);

        //Categories
        DB::table('categories')->insert([
            [
                'id' => 1,
                'programmers_id' => 1,
                'name' => 'Demo',
                'description' => 'Primera categoría demo, creada para las pruebas de integración',
                'icons_id' => 3,
                'colors_id' => 1,
                'users_id' => 1,
            ],
            [
                'id' => 2,
                'programmers_id' => 1,
                'name' => 'Test',
                'description' => 'Segunda categoría demo, creada para las pruebas de integración',
                'icons_id' => 4,
                'colors_id' => 2,
                'users_id' => 1,
            ],
            [
                'id' => 3,
                'programmers_id' => 1,
                'name' => 'Desarrollo',
                'description' => 'Tercera categoría demo, creada para las pruebas de integración',
                'icons_id' => 6,
                'colors_id' => 3,
                'users_id' => 1,
            ],
            [
                'id' => 4,
                'programmers_id' => 1,
                'name' => 'Seguimiento',
                'description' => 'Cuarta categoría demo, creada para las pruebas de integración',
                'icons_id' => 27,
                'colors_id' => 3,
                'users_id' => 1,
            ]

        ]);

    }
}
