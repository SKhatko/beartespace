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
				'month_price'     => '9.99',
				'year_price'      => '99.29'
			],
			[
				'name'      => 'basic',
				'user_type' => 'artist',
				'month_price'     => '10.99',
				'year_price'      => '80.29'
			],
			[
				'name'      => 'expanded',
				'user_type' => 'user',
				'month_price'     => '11.99',
				'year_price'      => '89.29'
			],
			[
				'name'      => 'expanded',
				'user_type' => 'artist',
				'month_price'     => '15.99',
				'year_price_price'      => '100.29'
			],
		] );
	}
}
