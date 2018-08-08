<?php

use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table( 'languages' )->insert( [
			[
				'code'   => 'en',
				'name'   => 'English',
				'is_rtl' => false,
				'active' => true,
			],
			[
				'code'   => 'da',
				'name'   => 'Danish',
				'is_rtl' => false,
				'active' => true,
			],
			[
				'code'   => 'uk',
				'name'   => 'Ukrainian',
				'is_rtl' => false,
				'active' => true,
			]
		] );

	}
}
