<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artworks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('slug')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('inspiration')->nullable();
            $table->decimal('height', 5, 3)->nullable();
            $table->decimal('width', 5, 3)->nullable();
            $table->decimal('depth', 5, 3)->nullable();
            $table->decimal('weight', 5, 3)->nullable();
            $table->date('date_of_completion')->nullable();
	        $table->decimal('price', 12,2)->nullable();
            $table->string('category')->nullable();
            $table->text('medium')->nullable();
            $table->text('direction')->nullable();
            $table->text('theme')->nullable();
            $table->text('color')->nullable();

            //0 =pending for review, 1= published, 2=blocked, 3=archived
            $table->enum('status', [0,1,2,3])->nullable();
	        $table->boolean('auction_status')->nullable();
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
        Schema::drop('artworks');
    }
}
