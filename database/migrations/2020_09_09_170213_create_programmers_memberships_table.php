<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreateProgrammersMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programmers_memberships', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->integer('programmers_id');
            $table->integer('prices_memberships_countries_id');
            $table->integer('payments_id');
            $table->integer('status_programmers_memberships_id');
            $table->enum('unit_type',['m', 'y'])->comment('m:Monthly, y: Yeraly');
            $table->datetime('created_at')->default(new Expression('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')->default(new Expression('CURRENT_TIMESTAMP'));

            $table->primary([
                                'id',
                                'programmers_id',
                                'prices_memberships_countries_id',
                                'payments_id',
                                'status_programmers_memberships_id'
                            ],
                                'programmers_memberships_primaries'
                            );

            $table->foreign('programmers_id')
                    ->references('id')->on('programmers')
                    ->onUpdate('NO ACTION')
                    ->onDelete('NO ACTION');
            $table->foreign('prices_memberships_countries_id')
                    ->references('id')->on('prices_memberships_countries')
                    ->onUpdate('NO ACTION')
                    ->onDelete('NO ACTION');
            $table->foreign('payments_id')
                    ->references('id')->on('payments')
                    ->onUpdate('NO ACTION')
                    ->onDelete('NO ACTION');
            $table->foreign('status_programmers_memberships_id', 'spm_id_foreign')
                    ->references('id')->on('status_programmers_memberships')
                    ->onUpdate('NO ACTION')
                    ->onDelete('NO ACTION');

            $table->index([
                            'programmers_id',
                            'prices_memberships_countries_id',
                            'payments_id',
                            'status_programmers_memberships_id'
                        ],
                            'programmers_memberships_indexes'
                        );
        });

        //Add autoincrement to id
        DB::statement("ALTER TABLE programmers_memberships MODIFY id INT AUTO_INCREMENT");
        //Add comment to table
        DB::statement("ALTER TABLE programmers_memberships comment 'Relation programers with memberships'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programmers_memberships');
    }
}
