<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreateIdentificationsTypesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identifications_types_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->integer('identifications_types_id');
            $table->string('language',2)->comment('ISO 639-1 Two-letter');
            $table->string('name',100);
            $table->datetime('created_at')->default(new Expression('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')->default(new Expression('CURRENT_TIMESTAMP'));

            $table->primary([
                                'id', 'identifications_types_id'
                            ],
                                'identifications_types_translations_ids'
                            );

            $table->foreign('identifications_types_id', 'identifications_types_id_foreign')
                ->references('id')->on('identifications_types')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');

            $table->index([
                            'identifications_types_id'
                        ],
                            'identifications_types_translations_indexes'
                        );

        });

        //Add autoincrement to id
        DB::statement("ALTER TABLE identifications_types_translations MODIFY id INT AUTO_INCREMENT");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('identifications_types_translations');
    }
}
