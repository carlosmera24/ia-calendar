<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreateLogsStatusParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs_status_participants', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->integer('participants_id');
            $table->integer('status_participants_id');
            $table->text('description');
            $table->datetime('created_at')->default(new Expression('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')->default(new Expression('CURRENT_TIMESTAMP'));

            $table->primary([
                                'id',
                                'participants_id',
                                'status_participants_id',
                            ],
                            'logs_status_participants_ids'
                        );

            $table->foreign('participants_id')
                ->references('id')->on('participants')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('status_participants_id')
                ->references('id')->on('status_participants')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');

            $table->index(  [
                                'participants_id',
                                'status_participants_id',
                            ],
                            'logs_status_participants_indexes'
                        );
        });

        //Add autoincrement to id
        DB::statement("ALTER TABLE logs_status_participants MODIFY id INT AUTO_INCREMENT");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs_status_participants');
    }
}
