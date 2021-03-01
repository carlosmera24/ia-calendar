<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasswordChangeRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('password_change_requests', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->integer('users_id');
            $table->integer('users_id_record')->comment('User who registered the request');
            $table->integer('status_password_change_requests_id');
            $table->datetime('created_at')->default(new Expression('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')->default(new Expression('CURRENT_TIMESTAMP'));

            $table->primary(
                                [
                                    'id',
                                    'users_id',
                                    'users_id_record',
                                    'status_password_change_requests_id'
                                ],
                                'password_change_requests_ids'
                            );

            $table->foreign('users_id')->references('id')->on('users')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('users_id_record')->references('id')->on('users')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('status_password_change_requests_id')->references('id')->on('status_password_change_requests_id')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');

            $table->index(
                            [
                                'id',
                                'users_id',
                                'users_id_record',
                                'status_password_change_requests_id'
                            ],
                            'password_change_requests_indexs'
                        );
        });

        //Add autoincrement to id
        DB::statement("ALTER TABLE password_change_requests MODIFY id INT AUTO_INCREMENT");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('password_change_requests');
    }
}
