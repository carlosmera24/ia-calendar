<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreatePermissionsParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions_participants', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->integer('participants_id');
            $table->integer('permissions_id');
            $table->datetime('created_at')->default(new Expression('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')->default(new Expression('CURRENT_TIMESTAMP'));

            $table->primary([
                                'id',
                                'participants_id',
                                'permissions_id'
                            ],
                                'permissions_participants_id'
                            );

            $table->foreign('participants_id')
                    ->references('id')->on('participants')
                    ->onUpdate('NO ACTION')
                    ->onDelete('NO ACTION');
            $table->foreign('permissions_id')
                    ->references('id')->on('permissions')
                    ->onUpdate('NO ACTION')
                    ->onDelete('NO ACTION');

            $table->index([
                            'participants_id',
                            'permissions_id',
                        ],
                            'permissions_participants_indexes'
                        );
        });

        //Add autoincrement to id
        DB::statement("ALTER TABLE permissions_participants MODIFY id INT AUTO_INCREMENT");
        //Add comment to table
        DB::statement("ALTER TABLE permissions_participants COMMENT 'Relation for permissions and participants'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permisions_participants');
    }
}
