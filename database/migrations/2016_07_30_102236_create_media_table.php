<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->integer('artwork_id')->nullable();
	        $table->integer('avatar_id')->nullable();
	        $table->integer('image_id')->nullable();
	        $table->integer('article_id')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('url')->nullable();
            $table->string('folder')->nullable();
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
        Schema::drop('media');
    }
}
