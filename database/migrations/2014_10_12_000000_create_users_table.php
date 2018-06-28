<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::defaultStringLength( 256 );

		Schema::create( 'users', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->string( 'name' )->nullable();
			$table->string( 'first_name' )->nullable();
			$table->string( 'last_name' )->nullable();
			$table->string( 'user_name' )->nullable();
			$table->string( 'email' )->unique()->nullable();
			$table->string( 'email_token' )->nullable();
			$table->string( 'password' )->nullable();

			$table->date('dob')->nullable();
			$table->integer( 'country_id' )->nullable();
			$table->string( 'mobile' )->nullable();
			$table->enum( 'gender', [ 'male', 'female', 'third_gender' ] )->nullable();
			$table->string( 'address' )->nullable();
			$table->string( 'website' )->nullable();
			$table->string( 'phone' )->nullable();
			$table->string( 'education' )->nullable();
			$table->string( 'education_title' )->nullable();
			$table->text('inspiration')->nullable();
			$table->text('exhibition')->nullable();
			$table->text('technique')->nullable();

			$table->enum( 'user_type', [ 'user', 'admin', 'artist', 'gallery' ] )->nullable();
			//active_status 0:pending, 1:active, 2:block;
			$table->enum( 'active_status', [ 0, 1, 2 ] )->nullable();
			// email_verified 0:unverified, 1:verified
			$table->boolean( 'email_verified' )->nullable();
			//is_online => 0:offline, 1:online;
			$table->boolean( 'is_online' )->nullable();

			$table->timestamp( 'last_login' )->nullable();
			$table->string('api_token', 60)->unique();
			$table->rememberToken();
			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop( 'users' );
	}
}
