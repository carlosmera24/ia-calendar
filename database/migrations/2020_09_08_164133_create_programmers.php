<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreateProgrammers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programmers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id')->autoIncrement();
            $table->string('entity_name',120);
            $table->string('NIT',100);
            $table->text('logo')->comment('Logo in format String64')->nullable();
            $table->tinyInteger('activated_birthday',false)->default(0)->comment('0: InActive, 1:Active');
            $table->tinyInteger('activated_date_join_company',false)->default('0')->comment('0: InActive, 1:Active');
            $table->tinyInteger('activated_tax_calendar',false)->default('0')->comment('0: InActive, 1:Active');
            $table->tinyInteger('activated_car_tax',false)->default('0')->comment('0: InActive, 1:Active');
            $table->tinyInteger('activated_ss_tax',false)->default('0')->comment('0: InActive, 1:Active');
            $table->datetime('created_at')->default(new Expression('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')->default(new Expression('CURRENT_TIMESTAMP'));

        });

        DB::statement("ALTER TABLE programmers comment 'Programador'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programmers');
    }
}
