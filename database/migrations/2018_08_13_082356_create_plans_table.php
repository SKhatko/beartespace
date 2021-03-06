<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('name');
	        $table->enum('user_type', ['user', 'artist', 'gallery']);
	        $table->decimal('month_price', 12,2)->nullable();
	        $table->decimal('month', 12,2)->nullable();
	        $table->decimal('year_price', 12,2)->nullable();
	        $table->decimal('year', 12,2)->nullable();
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
        Schema::dropIfExists('plans');
    }
}
