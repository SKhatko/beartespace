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
			$table->string( 'url' )->nullable();
			$table->string( 'profile_name' )->nullable();
			$table->string( 'company_name' )->nullable();
			$table->string( 'email' )->unique()->nullable();
			$table->string( 'password' )->nullable();
			$table->integer( 'balance' )->default( 0 );
			$table->json( 'profession' )->nullable();
			$table->integer( 'avatar_id' )->nullable();
			$table->integer( 'image_id' )->nullable();

			$table->date( 'dob' )->nullable();
			$table->integer( 'country_id' )->nullable();
			$table->integer( 'nationality_id' )->nullable();
			$table->integer( 'currency_id' )->nullable();
			$table->string( 'city' )->nullable();
			$table->string( 'postcode' )->nullable();
			$table->enum( 'gender', [ 'male', 'female', 'third', 'none' ] )->nullable();
			$table->integer( 'address_id' )->nullable();
			$table->string( 'address' )->nullable();
			$table->string( 'address_2' )->nullable();
			$table->string( 'region' )->nullable();
			$table->string( 'phone' )->nullable();
			$table->string( 'education' )->nullable();
			$table->string( 'education_title' )->nullable();
			$table->boolean( 'education_born' )->nullable();
			$table->text( 'about' )->nullable();
			$table->text( 'inspiration' )->nullable();
			$table->text( 'exhibition' )->nullable();

			$table->enum( 'seller_type', ['artist', 'gallery'] )->nullable();
			// seller_status 0:pending, 1:active, 2:block, 3:reject;
			$table->enum( 'seller_status', [ 0, 1, 2, 3 ] )->nullable;

//			$table->enum( 'user_type', [ 'user', 'admin', 'artist', 'gallery' ] )->nullable();
			$table->enum( 'role', [ 'user', 'admin', 'superadmin', 'writer', 'advertiser' ] )->nullable();
			$table->string( 'activation_token' )->nullable();
			// active_status 0:pending, 1:active, 2:block;
			$table->enum( 'active', [ 0, 1, 2 ] )->default( 0 )->nullable;
			$table->boolean( 'email_verified' )->nullable();
			//is_online => 0:offline, 1:online;
			$table->boolean( 'is_online' )->nullable();
			$table->timestamp( 'last_login' )->nullable();

			// Braintree
			$table->string( 'braintree_id' )->nullable();
			$table->string( 'paypal_email' )->nullable();
			$table->string( 'card_brand' )->nullable();
			$table->string( 'card_last_four' )->nullable();
			$table->timestamp( 'trial_ends_at' )->nullable();
			// End Braintree

			$table->rememberToken();
			$table->timestamps();
			$table->softDeletes();
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
