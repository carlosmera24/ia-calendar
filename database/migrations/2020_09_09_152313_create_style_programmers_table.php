<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreateStyleProgrammersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('style_programmers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->string('name',45);
            $table->text('description')->nullable();
            $table->integer('colors_id');
            $table->datetime('created_at')->default(new Expression('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')->default(new Expression('CURRENT_TIMESTAMP'));

            $table->primary(['id', 'colors_id']);

            $table->foreign('colors_id')->references('id')->on('colors')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');

            $table->index('colors_id');
        });

        //Add autoincrement to id
        DB::statement("ALTER TABLE style_programmers MODIFY id INT AUTO_INCREMENT");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('style_programmers');
    }
}
