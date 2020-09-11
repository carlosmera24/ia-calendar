<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreateUpdatedPasswordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('updated_password', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->text('old_password');
            $table->datetime('created')->default( new Expression('CURRENT_TIMESTAMP'));
            $table->integer('users_id');

            $table->primary([
                                'id',
                                'users_id'
                            ]);

            $table->foreign('users_id')
                ->references('id')->on('users')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');

            $table->index('users_id');
        });

        //Add autoincrement to id
        DB::statement("ALTER TABLE updated_password MODIFY id INT AUTO_INCREMENT");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('updated_password');
    }
}
