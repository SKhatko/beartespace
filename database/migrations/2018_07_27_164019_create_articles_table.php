<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('source')->nullable();
            $table->string('source_url')->nullable();
            $table->json('tags')->nullable();
            $table->longText('content')->nullable();
            $table->string('slug')->nullable();
            $table->integer('language_id')->nullable();
            $table->boolean('active')->nullable();
            $table->boolean('show_index')->nullable();
            $table->integer('user_id');
            $table->integer('image_id')->nullable();
            $table->timestamp('publish_at')->nullable();
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
        Schema::dropIfExists('articles');
    }
}
