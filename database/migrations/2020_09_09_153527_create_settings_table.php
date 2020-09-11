<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->integer('programmers_id');
            $table->integer('style_categories_id');
            $table->integer('fonts_id');
            $table->integer('style_programmers_id');
            $table->datetime('created_at')->default(new Expression('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')->default(new Expression('CURRENT_TIMESTAMP'));

            $table->primary([
                                'id',
                                'programmers_id',
                                'style_categories_id',
                                'fonts_id',
                                'style_programmers_id'
                            ],
                            'settings_id_primaries'
                        );

            $table->foreign('programmers_id')
                ->references('id')->on('programmers')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('style_categories_id')
                ->references('id')->on('style_categories')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('fonts_id')
                ->references('id')->on('fonts')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('style_programmers_id')
                ->references('id')->on('style_programmers')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');

            $table->index([
                            'programmers_id',
                            'style_categories_id',
                            'fonts_id',
                            'style_programmers_id'
                        ],
                        'settings_id_indexes'
                        );
        });

        //Add autoincrement to id
        DB::statement("ALTER TABLE settings MODIFY id INT AUTO_INCREMENT");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
