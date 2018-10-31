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

		DB::table( 'users' )->insert( [
			[
				'first_name'       => 'Stanislav',
				'last_name'        => 'Khatko',
				'email'            => 's.a.hatko@gmail.com',
				'password'         => bcrypt( '123456' ),
				'activation_token' => str_random( 60 ),
				'user_type'        => 'admin',
				'email_verified'   => true,
				'created_at'       => now(),
				'user_name'        => 'skhatko'
			],
			[
				'first_name'       => 'Support',
				'last_name'        => 'Team',
				'email'            => 'support@beartespace.com',
				'password'         => bcrypt( '123456' ),
				'activation_token' => str_random( 60 ),
				'user_type'        => 'admin',
				'email_verified'   => true,
				'created_at'       => now(),
				'user_name'        => 'support-team'
			],
			[
				'first_name'       => 'Oleksandra',
				'last_name'        => 'Lyhoshvaj',
				'email'            => 'aleksandralihosvaj@gmail.com',
				'password'         => bcrypt( '123456' ),
				'activation_token' => str_random( 60 ),
				'user_type'        => 'admin',
				'email_verified'   => true,
				'created_at'       => now(),
				'user_name'        => 'alex'
			],
			[
				'first_name'       => 'Customer',
				'last_name'        => 'Family',
				'email'            => 'customer@gmail.com',
				'password'         => bcrypt( '123456' ),
				'activation_token' => str_random( 60 ),
				'user_type'        => 'user',
				'email_verified'   => true,
				'created_at'       => now(),
				'user_name'        => ''
			],
			// Artists
			[
				'first_name'       => 'Artist',
				'last_name'        => 'Family',
				'email'            => 'artist@gmail.com',
				'password'         => bcrypt( '123456' ),
				'activation_token' => str_random( 60 ),
				'user_type'        => 'artist',
				'email_verified'   => true,
				'created_at'       => now(),
				'user_name'        => 'artist-family'
			],
			[
				'first_name'       => 'Jon',
				'last_name'        => 'Doe',
				'email'            => 'atist@gmail.com',
				'password'         => bcrypt( '123456' ),
				'activation_token' => str_random( 60 ),
				'user_type'        => 'artist',
				'email_verified'   => true,
				'created_at'       => now(),
				'user_name'        => 'jon'
			],
			[
				'first_name'       => 'Namee',
				'last_name'        => 'Dump',
				'email'            => 'arist@gmail.com',
				'password'         => bcrypt( '123456' ),
				'activation_token' => str_random( 60 ),
				'user_type'        => 'artist',
				'email_verified'   => true,
				'created_at'       => now(),
				'user_name'        => 'namee'
			],
			[
				'first_name'       => 'Weil',
				'last_name'        => 'Garry',
				'email'            => 'artst@gmail.com',
				'password'         => bcrypt( '123456' ),
				'activation_token' => str_random( 60 ),
				'user_type'        => 'artist',
				'email_verified'   => true,
				'created_at'       => now(),
				'user_name'        => 'weil'
			]
		] );
	}
}
