<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Artwork;

class TestingSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
//		factory(App\User::class, 50)->create();

		factory( App\User::class, 20 )->create()->each( function ( $u ) {
			$u->artworks()->save( factory( App\Artwork::class )->make( [
				'user_id' => $u->id
			] ) );
		} );


		$users = User::all();

		foreach ( $users as $user ) {
			$user->artworks()->saveMany( factory( App\Artwork::class, 10 )->make() );
			$user->photo()->save( factory( App\Media::class )->make( [
				'url' => 'https://picsum.photos/' . random_int( 1, 1920 ) . '/' . random_int( 1, 1920 ),
			] ) );
		}

		$artworks = Artwork::all();

		foreach ( $artworks as $artwork ) {
			$artwork->images()->saveMany( factory( App\Media::class, random_int( 1, 4 ) )->make() );
		}
	}
}
