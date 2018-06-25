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
            $table->string('slug')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('inspiration')->nullable();
            $table->float('height', 2)->nullable();
            $table->float('width', 2)->nullable();
            $table->float('depth', 2)->nullable();
            $table->float('weight', 2)->nullable();
            $table->date('date_of_completion')->nullable();
	        $table->decimal('price', 12,2)->nullable();

            $table->integer('category_id')->nullable();

            $table->string('medium')->nullable();
            $table->string('direction')->nullable();
            $table->string('theme')->nullable();
            $table->string('color')->nullable();

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
