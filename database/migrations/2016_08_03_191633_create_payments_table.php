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
	        $table->string('transaction_id');
	        $table->decimal('amount')->nullable();
	        $table->json('charge')->nullable();
	        $table->string('description')->nullable();
	        $table->enum('status', ['initial','pending','success','failed','declined','dispute'])->nullable()->default('initial');
            $table->string('charge_id_or_token')->nullable();

            //payment created column will be use by gateway
            $table->integer('payment_created')->nullable();
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
