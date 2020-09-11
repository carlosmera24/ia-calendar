<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreatePricesMembershipsCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices_memberships_countries', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->integer('countries_id');
            $table->integer('memberships_id');
            $table->double('price');
            $table->enum('unit_type',['m', 'y'])->comment('m:Monthly, y: Yeraly');
            $table->datetime('created_at')->default(new Expression('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')->default(new Expression('CURRENT_TIMESTAMP'));

            $table->primary([
                                'id',
                                'countries_id',
                                'memberships_id'
                            ],
                            'prices_memberships_countries_primaries'
                        );

            $table->foreign('countries_id')
                    ->references('id')->on('countries')
                    ->onUpdate('NO ACTION')
                    ->onDelete('NO ACTION');
            $table->foreign('memberships_id')
                    ->references('id')->on('memberships')
                    ->onUpdate('NO ACTION')
                    ->onDelete('NO ACTION');

            $table->index([
                            'countries_id',
                            'memberships_id'
                        ],

                            'prices_memberships_countries_indexes'
                        );
        });

        //Add autoincrement to id
        DB::statement("ALTER TABLE prices_memberships_countries MODIFY id INT AUTO_INCREMENT");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prices_memberships_countries');
    }
}
