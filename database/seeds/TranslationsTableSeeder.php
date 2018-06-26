<?php

use Illuminate\Database\Seeder;

class TranslationsTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {

		$translations = [
			'medium' => [
				[ 'Acrylic on Indian cotton', 'Akryl på indisk bomuld' ],
				[ 'Indian cotton', 'indisk bomuld' ],
			],
			'category' => [
			],
		];

		foreach ( $translations as $medium => $trans ) {

			foreach ( $trans as $tran ) {
				$key = str_slug( $tran[0], '-' );

				DB::table( 'language_lines' )->insert( [
					'group' => $medium,
					'key'   => $key,
					'text'  => json_encode([ 'en' => $tran[0], 'da' => $tran[1] ]),
				] );
			}
		}
	}
}
