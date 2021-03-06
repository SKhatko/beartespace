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
				'seller_type'      => 'gallery',
				'seller_status'    => 'active',
				'role'             => 'admin',
				'email_verified'   => true,
				'created_at'       => now(),
			],
			[
				'first_name'       => 'Support',
				'last_name'        => 'Team',
				'email'            => 'support@beartespace.com',
				'password'         => bcrypt( '123456' ),
				'activation_token' => str_random( 60 ),
				'seller_type'      => null,
				'seller_status'    => null,
				'role'             => 'admin',
				'email_verified'   => true,
				'created_at'       => now(),
			],
			[
				'first_name'       => 'Oleksandra',
				'last_name'        => 'Lyhoshvaj',
				'email'            => 'aleksandralihosvaj@gmail.com',
				'password'         => bcrypt( '123456' ),
				'activation_token' => str_random( 60 ),
				'seller_type'      => 'gallery',
				'seller_status'    => 'active',
				'role'             => 'admin',
				'email_verified'   => true,
				'created_at'       => now(),
			],
			[
				'first_name'       => 'Customer',
				'last_name'        => 'Family',
				'email'            => 'customer@gmail.com',
				'password'         => bcrypt( '123456' ),
				'activation_token' => str_random( 60 ),
				'seller_type'      => null,
				'seller_status'    => null,
				'role'             => 'admin',
				'email_verified'   => true,
				'created_at'       => now(),
			],
			// Artists
			[
				'first_name'       => 'Artist',
				'last_name'        => 'Family',
				'email'            => 'artist@gmail.com',
				'password'         => bcrypt( '123456' ),
				'activation_token' => str_random( 60 ),
				'seller_type'      => 'artist',
				'seller_status'    => 'active',
				'role'             => 'admin',
				'email_verified'   => true,
				'created_at'       => now(),
			],
			[
				'first_name'       => 'Jon',
				'last_name'        => 'Doe',
				'email'            => 'atist@gmail.com',
				'password'         => bcrypt( '123456' ),
				'activation_token' => str_random( 60 ),
				'seller_type'      => 'artist',
				'role'             => null,
				'seller_status'    => null,
				'email_verified'   => true,
				'created_at'       => now(),
			],
			[
				'first_name'       => 'Namee',
				'last_name'        => 'Dump',
				'email'            => 'arist@gmail.com',
				'password'         => bcrypt( '123456' ),
				'activation_token' => str_random( 60 ),
				'seller_type'      => 'artist',
				'role'             => null,
				'seller_status'    => null,
				'email_verified'   => true,
				'created_at'       => now(),
			],
			[
				'first_name'       => 'Weil',
				'last_name'        => 'Garry',
				'email'            => 'artst@gmail.com',
				'password'         => bcrypt( '123456' ),
				'activation_token' => str_random( 60 ),
				'seller_type'      => 'artist',
				'role'             => null,
				'seller_status'    => null,
				'email_verified'   => true,
				'created_at'       => now(),
			]
		] );
	}
}
