<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'id' => 1,
            'name' => 'categories.index',
            'description' => 'Consultar categorías',
        ]);

        DB::table('permissions')->insert([
            'id' => 2,
            'name' => 'categories.create',
            'description' => 'Crear categorías',
        ]);

        DB::table('permissions')->insert([
            'id' => 3,
            'name' => 'categories.edit',
            'description' => 'Editar categorías',
        ]);

        DB::table('permissions')->insert([
            'id' => 4,
            'name' => 'categories.delete',
            'description' => 'Eliminar categorías',
        ]);

        DB::table('permissions')->insert([
            'id' => 5,
            'name' => 'categories.share',
            'description' => 'Compartir categorías',
        ]);

        DB::table('permissions')->insert([
            'id' => 6,
            'name' => 'events.index',
            'description' => 'Consultar eventos',
        ]);

        DB::table('permissions')->insert([
            'id' => 7,
            'name' => 'events.create',
            'description' => 'Crear eventos',
        ]);

        DB::table('permissions')->insert([
            'id' => 8,
            'name' => 'events.edit',
            'description' => 'Editar eventos',
        ]);

        DB::table('permissions')->insert([
            'id' => 9,
            'name' => 'events.delete',
            'description' => 'Eliminar eventos',
        ]);

        DB::table('permissions')->insert([
            'id' => 10,
            'name' => 'events.share',
            'description' => 'Compartir eventos',
        ]);

        DB::table('permissions')->insert([
            'id' => 11,
            'name' => 'categories.administrator.access',
            'description' => 'Acceso a categorías creadas por el administrador',
        ]);

        DB::table('permissions')->insert([
            'id' => 12,
            'name' => 'events.administrator.access',
            'description' => 'Acceso a eventos creados por el administrador',
        ]);
    }
}
