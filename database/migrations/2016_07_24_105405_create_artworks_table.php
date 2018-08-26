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
            $table->boolean('optional_size')->nullable();
            $table->decimal('height', 5, 3)->nullable();
            $table->decimal('b_height', 5, 3)->nullable();
            $table->decimal('width', 5, 3)->nullable();
            $table->decimal('b_width', 5, 3)->nullable();
            $table->decimal('depth', 5, 3)->nullable();
            $table->decimal('b_depth', 5, 3)->nullable();
            $table->decimal('weight', 5, 3)->nullable();
            $table->decimal('b_weight', 5, 3)->nullable();
            $table->timestamp('date_of_completion')->nullable();
	        $table->decimal('price', 12,2)->nullable();
	        $table->string('currency')->nullable();
            $table->string('category')->nullable();
            $table->json('medium')->nullable();
            $table->json('direction')->nullable();
            $table->json('theme')->nullable();
            $table->json('color')->nullable();
            $table->string('shape')->nullable();

            //0 =pending for review, 1= published, 2=blocked, 3=archived
            $table->enum('status', [0,1,2,3])->nullable();
	        $table->boolean('auction_status')->nullable();
	        $table->decimal('auction_price', 12,2)->nullable();
	        $table->timestamp('auction_start')->nullable();
	        $table->timestamp('auction_end')->nullable();
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
