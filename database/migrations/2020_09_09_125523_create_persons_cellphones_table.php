<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreatePersonsCellphonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons_cellphones', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->string('cellphone_number',45);
            $table->integer('persons_id');
            $table->datetime('created_at')->default(new Expression('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')->default(new Expression('CURRENT_TIMESTAMP'));

            $table->primary([
                                'id',
                                'persons_id'
                            ]);

            $table->foreign('persons_id')
                    ->references('id')->on('persons')
                    ->onUpdate('NO ACTION')
                    ->onDelete('NO ACTION');

            $table->index('persons_id');
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
        Schema::dropIfExists('persons_cellphones');
    }
}
