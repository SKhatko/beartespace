<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		factory(App\User::class, 50)->create();

		DB::table( 'users' )->insert( [
			[
				'first_name'       => 'Stanislav',
				'last_name'        => 'Khatko',
				'email'            => 's.a.hatko@gmail.com',
				'user_name'        => 'admin',
				'password'         => bcrypt( '123456' ),
				'gender'           => 'male',
				'activation_token' => str_random( 60 ),
				'user_type'        => 'admin',
				'email_verified'   => true,
			],
			[
				'first_name'       => 'Support',
				'last_name'        => 'Team',
				'email'            => 'support@beartespace.com',
				'user_name'        => 'admin',
				'password'         => bcrypt( '123456' ),
				'gender'           => 'third_gender',
				'activation_token' => str_random( 60 ),
				'user_type'        => 'admin',
				'email_verified'   => true,
			],
			[
				'first_name'       => 'Oleksandra',
				'last_name'        => 'Lyhoshvaj',
				'email'            => 'aleksandralihosvaj@gmail.com',
				'user_name'        => 'Alex',
				'password'         => bcrypt( '123456' ),
				'activation_token' => str_random( 60 ),
				'gender'           => 'female',
				'user_type'        => 'admin',
				'email_verified'   => true,
			],
			[
				'first_name'       => 'Customer',
				'last_name'        => 'Family',
				'email'            => 'customer@gmail.com',
				'user_name'        => '',
				'password'         => bcrypt( '123456' ),
				'activation_token' => str_random( 60 ),
				'gender'           => 'female',
				'user_type'        => 'user',
				'email_verified'   => true,
			],
			[
				'first_name'       => 'Artist',
				'last_name'        => 'Family',
				'email'            => 'artist@gmail.com',
				'user_name'        => '',
				'password'         => bcrypt( '123456' ),
				'activation_token' => str_random( 60 ),
				'gender'           => 'male',
				'user_type'        => 'artist',
				'email_verified'   => true,
			]
		] );
	}
}
