<?php

use Illuminate\Database\Seeder;

class TestingSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		factory( App\User::class, 50 )->create()->each( function ( $u ) {
			$u->artworks()->save( factory( App\Artwork::class )->make( [
				'user_id' => $u->id
			] ) );
		} );
	}
}
