<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreateMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id')->autoIncrement();
            $table->string('name',60);
            $table->text('description')->nullable();
            $table->integer('limit_categories')->default(null)->comment('NULL = Infinite, Not limit');
            $table->integer('limit_events')->default(null)->comment('NULL = Infinite, Not limit');
            $table->integer('limit_participants')->default(null)->comment('NULL = Infinite, Not limit');
            $table->integer('limit_files_import')->default(null)->comment('NULL = Infinite, Not limit');
            $table->integer('limit_cellphones')->default(null)->comment('NULL = Infinite, Not limit');
            $table->integer('limit_emails')->default(null)->comment('NULL = Infinite, Not limit');
            $table->tinyinteger('activated_annual_fiscal',false)->comment('0: Inactivate, 1:Active');
            $table->tinyinteger('reminder_change_password',false)->comment('0: Inactivate, 1:Active');
            $table->integer('profiles_participants_id');
            $table->datetime('created_at')->default(new Expression('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')->default(new Expression('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('memberships');
    }
}
