<?php

use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table( 'options' )->insert( [
			[
				'name'       => 'artists_of_the_week',
				'json_value' => json_encode( [] ),
				'text_value' => null,
			],
			[
				'name'       => 'artworks_of_the_week',
				'json_value' => json_encode( [] ),
				'text_value' => null,
			],
			[
				'name'       => 'test',
				'json_value' => null,
				'text_value' => 'test string',
			],
		] );
	}
}
