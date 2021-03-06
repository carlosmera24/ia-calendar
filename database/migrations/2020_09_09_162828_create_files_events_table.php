<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreateFilesEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files_events', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->string('name',45);
            $table->string('mime_type',45);
            $table->text('path')->nullable();
            $table->integer('events_id');
            $table->datetime('created_at')->default(new Expression('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')->default(new Expression('CURRENT_TIMESTAMP'));

            $table->primary([
                                'id',
                                'events_id',
                            ]);

            $table->foreign('events_id')
                ->references('id')->on('events')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');

            $table->index('events_id');
        });

        //Add autoincrement to id
        DB::statement("ALTER TABLE files_events MODIFY id INT AUTO_INCREMENT");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files_events');
    }
}
