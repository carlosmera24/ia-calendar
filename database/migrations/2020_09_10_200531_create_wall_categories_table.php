<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreateWallCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wall_categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->integer('participants_id');
            $table->integer('categories_id');
            $table->datetime('created_at')->default(new Expression('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')->default(new Expression('CURRENT_TIMESTAMP'));

            $table->primary([
                                'id',
                                'participants_id',
                                'categories_id'
                            ]);

            $table->foreign('participants_id')
                ->references('id')->on('participants')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('categories_id')
                ->references('id')->on('categories')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');

            $table->index([
                            'participants_id',
                            'categories_id'
                        ]);
        });

        //Add autoincrement to id
        DB::statement("ALTER TABLE wall_categories MODIFY id INT AUTO_INCREMENT");
        //Add comment to table
        DB::statement("ALTER TABLE wall_categories comment 'Relation programers with memberships'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wall_categories');
    }
}
