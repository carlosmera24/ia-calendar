<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreatePersonsEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons_emails', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->string('email',45);
            $table->tinyInteger('initial_register',false)->nullable()->default(0)->comment('0:No, 1:Yes');
            $table->tinyInteger('used_events',false)->nullable()->default(0)->comment('0:No, 1:Yes');
            $table->integer('persons_id');
            $table->datetime('created_at')->default(new Expression('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')->default(new Expression('CURRENT_TIMESTAMP'));
            $table->integer('status_persons_emails_id')->default(1);

            $table->primary([
                                'id',
                                'persons_id',
                                'status_persons_emails_id'
                            ]);

            $table->foreign('persons_id')->references('id')->on('persons')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('status_persons_emails_id')->references('id')->on('status_persons_emails')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');

            $table->index([
                            'persons_id',
                            'status_persons_emails_id'
                            ]);

        });

        //Add autoincrement to id
        DB::statement("ALTER TABLE persons_emails MODIFY id INT AUTO_INCREMENT");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persons_emails');
    }
}
