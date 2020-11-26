<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->integer('persons_id');
            $table->integer('programmers_id');
            $table->integer('users_id')->nullable();
            $table->integer('profiles_participants_id');
            $table->text('description')->nullable();
            $table->datetime('created_at')->default(new Expression('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')->default(new Expression('CURRENT_TIMESTAMP'));

            $table->primary([
                                'id',
                                'persons_id',
                                'programmers_id',
                                'profiles_participants_id'
                            ],
                            'participants_id_primaries'
                        );

            $table->foreign('persons_id')
                ->references('id')->on('persons')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('programmers_id')
                ->references('id')->on('programmers')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('users_id')
                ->references('id')->on('users')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('profiles_participants_id')
                ->references('id')->on('profiles_participants')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');

            $table->index([
                            'persons_id',
                            'programmers_id',
                            'users_id',
                            'profiles_participants_id'
                        ],
                            'participants_id_indexes'
                        );
        });

        //Add autoincrement to id
        DB::statement("ALTER TABLE participants MODIFY id INT AUTO_INCREMENT");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participants');
    }
}
