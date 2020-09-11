<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->integer('programmers_id');
            $table->string('name',60);
            $table->text('description')->nullable();
            $table->integer('icons_id');
            $table->integer('colors_id');
            $table->integer('users_id');
            $table->datetime('created_at')->default(new Expression('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')->default(new Expression('CURRENT_TIMESTAMP'));

            $table->primary([
                                'id',
                                'programmers_id',
                                'icons_id',
                                'colors_id',
                                'users_id'
                            ]);

            $table->foreign('programmers_id')
                ->references('id')->on('programmers')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('icons_id')
                ->references('id')->on('icons')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('colors_id')
                ->references('id')->on('colors')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('users_id')
                ->references('id')->on('users')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');

            $table->index([
                            'programmers_id',
                            'icons_id',
                            'colors_id',
                            'users_id'
                        ]);
        });

        //Add autoincrement to id
        DB::statement("ALTER TABLE categories MODIFY id INT AUTO_INCREMENT");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
