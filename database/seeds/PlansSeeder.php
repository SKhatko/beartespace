<?php

use Illuminate\Database\Seeder;

class PlansSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table( 'plans' )->insert( [
			[
				'name'      => 'basic',
				'user_type' => 'user',
				'month'     => '10.99',
				'year'      => '80.29'
			],
			[
				'name'      => 'basic',
				'user_type' => 'artist',
				'month'     => '10.99',
				'year'      => '80.29'
			],
			[
				'name'      => 'expanded',
				'user_type' => 'user',
				'month'     => '10.99',
				'year'      => '80.29'
			],
			[
				'name'      => 'expanded',
				'user_type' => 'artist',
				'month'     => '10.99',
				'year'      => '80.29'
			],
		] );
	}
}
