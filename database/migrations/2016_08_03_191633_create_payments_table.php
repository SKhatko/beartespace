<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
	        $table->integer('user_id')->nullable();
	        $table->integer('order_id')->nullable();
	        $table->string('transaction_id')->nullable();
	        $table->decimal('amount')->nullable();
	        $table->longText('transaction')->nullable();
//	        $table->enum('status', ['initial','pending','success','failed','declined','dispute'])->nullable()->default('initial');
	        $table->string('status')->nullable()->default('initial');
	        $table->text('fail_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('payments');
    }
}
