<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreateNotificationsSheduledEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications_sheduled_events', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->integer('events_id');
            $table->integer('value');
            $table->enum('type',['m', 'w', 'd', 'h', 'i'])->comment('m: Month, w: Week, d: Day, h: hour, i: Minute');
            $table->datetime('created_at')->default(new Expression('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')->default(new Expression('CURRENT_TIMESTAMP'));

            $table->primary([
                                'id',
                                'events_id'
                            ]);

            $table->foreign('events_id')
                    ->references('id')->on('events')
                    ->onUpdate('NO ACTION')
                    ->onDelete('NO ACTION');

            $table->index('events_id');
        });

        //Add autoincrement to id
        DB::statement("ALTER TABLE notifications_sheduled_events MODIFY id INT AUTO_INCREMENT");
        //Add comment to table
        DB::statement("ALTER TABLE notifications_sheduled_events COMMENT 'Notification scheduling record for events'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications_sheduled_events');
    }
}
