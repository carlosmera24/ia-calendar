<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreateParticipantsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants_categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->integer('categories_id');
            $table->integer('participants_id');
            $table->datetime('created_at')->default(new Expression('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')->default(new Expression('CURRENT_TIMESTAMP'));

            $table->primary([
                                'id',
                                'categories_id',
                                'participants_id'
                            ]);

            $table->foreign('categories_id')
                ->references('id')->on('categories')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('participants_id')
                ->references('id')->on('participants')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');

            $table->index([
                            'categories_id',
                            'participants_id'
                        ]);
        });

        //Add autoincrement to id
        DB::statement("ALTER TABLE participants_categories MODIFY id INT AUTO_INCREMENT");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participants_categories');
    }
}
