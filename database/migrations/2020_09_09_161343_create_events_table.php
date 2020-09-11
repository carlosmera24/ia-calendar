<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->integer('categories_id');
            $table->string('site',200);
            $table->time('date_start');
            $table->time('date_finish');
            $table->enum('continuity', ['0','1'])
                    ->nullable()
                    ->default(null)
                    ->comment('0:Daily, 1:Weekly, 2:Monthly, 3:yearly');
            $table->integer('duration')
                    ->comment('Duration in minutes');
            $table->string('subject',200);
            $table->text('detail');
            $table->integer('users_id');
            $table->datetime('created_at')->default(new Expression('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')->default(new Expression('CURRENT_TIMESTAMP'));

            $table->primary([
                                'id',
                                'categories_id',
                                'users_id'
                            ]);

            $table->foreign('categories_id')
                    ->references('id')->on('categories')
                    ->onUpdate('NO ACTION')
                    ->onDelete('NO ACTION');
            $table->foreign('users_id')
                    ->references('id')->on('users')
                    ->onUpdate('NO ACTION')
                    ->onDelete('NO ACTION');

            $table->index([
                            'categories_id',
                            'users_id'
                        ]);
        });

        //Add autoincrement to id
        DB::statement("ALTER TABLE events MODIFY id INT AUTO_INCREMENT");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
