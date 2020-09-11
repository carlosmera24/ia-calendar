<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreateCountriesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->integer('countries_id');
            $table->string('language',2)->commment('ISO 639-1 Two-letter');
            $table->string('name',100);
            $table->datetime('created_at')->default(new Expression('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')->default(new Expression('CURRENT_TIMESTAMP'));

            $table->primary([
                                'id',
                                'countries_id'
                            ]);

            $table->foreign('countries_id')
                    ->references('id')->on('countries')
                    ->onUpdate('NO ACTION')
                    ->onDelete('NO ACTION');

            $table->index('countries_id');
        });

        //Add autoincrement to id
        DB::statement("ALTER TABLE countries_translations MODIFY id INT AUTO_INCREMENT");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries_translations');
    }
}
