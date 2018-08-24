<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table( 'settings' )->insert( [
			[
				'artists_of_the_week' => json_encode([]),
				'artworks_of_the_week' => json_encode([]),
			]
		] );
	}
}
