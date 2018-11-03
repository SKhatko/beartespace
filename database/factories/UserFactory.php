<?php

use Faker\Generator as Faker;

$factory->define( App\User::class, function ( Faker $faker ) {
	return [
		'first_name'       => $faker->firstName,
		'last_name'        => $faker->lastName,
		'email'            => $faker->unique()->safeEmail,
		'profile_name'     => $faker->userName,
		'password'         => bcrypt( '123456' ),
		'gender'           => $faker->randomElement( [ 'male', 'female', 'third' ] ),
		'remember_token'   => str_random( 10 ),
		'dob'              => $faker->date( $format = 'Y-m-d', $max = 'now' ),
		'country_id'       => $faker->numberBetween( 0, 246 ),
		'profession'       => $faker->words( random_int( 0, 20 ) ),
		'phone'            => $faker->phoneNumber,
		'address'          => $faker->address,
		'address_2'        => $faker->address,
		'education'        => $faker->company,
		'education_title'  => $faker->jobTitle,
		'inspiration'      => $faker->paragraph,
		'exhibition'       => $faker->paragraph,
		'role'             => $faker->randomElement( [ 'user', 'admin' ] ),
		'active'           => $faker->randomElement( [ 0, 1, 2, 3 ] ),
		'activation_token' => str_random( 60 ),
		'email_verified'   => false,
	];
} );
