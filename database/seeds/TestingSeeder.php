<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Artwork;
use App\Article;

class TestingSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
//		factory(App\User::class, 50)->create();

		if ( App::environment() !== 'production' ) {
			factory( App\User::class, 50 )->create()->each( function ( $user ) {
				$user->artworks()->save( factory( App\Artwork::class )->make( [
					'user_id' => $user->id
				] ) );
			} );
		}

		$users = User::all();

		if ( App::environment() !== 'production' ) {
			foreach ( $users as $user ) {

				if ( $user->user_type == 'artist' ) {
					$user->artworks()->saveMany( factory( App\Artwork::class, 30 )->make() );
				}

				$artworks = Artwork::all();
			}


			foreach ( $users as $user ) {

				if ( $user->user_type == 'artist' ) {
					$user->artworks()->saveMany( factory( App\Artwork::class, 3 )->make() );

//				$user->avatar()->associate( factory( App\Media::class )->create( [
//					'url' => 'https://picsum.photos/290/290',
//				] ) );
//				$user->save();
//
//				$user->image()->associate( factory( App\Media::class )->create() );
//				$user->save();
//
//				$user->articles()->saveMany( factory( App\Article::class, 5 )->make() );
				}
			}

			$artworks = Artwork::all();

//		foreach ( $artworks as $artwork ) {
//			dump($artwork->id);
//			$artwork->image()->associate( factory( App\Media::class )->create() );
//			$artwork->save();
//			$artwork->images()->saveMany( factory( App\Media::class, random_int( 1, 4 ) )->make() );
//		}

//		$articles = Article::all();
//
//		foreach ( $articles as $article ) {
//			$article->image()->associate( factory( App\Media::class )->make() );
//		$article->save():
//		}
		}
	}
