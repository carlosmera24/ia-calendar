<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->datetime('created_at')->default(new Expression('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')->default(new Expression('CURRENT_TIMESTAMP'));
            $table->integer('payment_status_id');
            $table->integer('payment_methods_id');

            $table->primary(['id','payment_status_id', 'payment_methods_id']);

            $table->foreign('payment_status_id')
                ->references('id')->on('payment_status')
                ->onUpdate('no action')
                ->onDelete('no action');

            $table->foreign('payment_methods_id')
                ->references('id')->on('payment_methods')
                ->onUpdate('no action')
                ->onDelete('no action');

            $table->index(['payment_status_id', 'payment_methods_id']);
        });

        //Add autoincrement to id
        DB::statement("ALTER TABLE payments MODIFY id INT AUTO_INCREMENT");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
