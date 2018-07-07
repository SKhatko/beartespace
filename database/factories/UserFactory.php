<?php

use Faker\Generator as Faker;

$factory->define( App\User::class, function ( Faker $faker ) {
	return [
		'first_name'      => $faker->firstName,
		'last_name'       => $faker->lastName,
		'user_name'       => $faker->userName,
		'email'           => $faker->unique()->safeEmail,
		'password'        => bcrypt( '123456' ),
		'remember_token'  => str_random( 10 ),
		'dob'             => $faker->date( $format = 'Y-m-d', $max = 'now' ),
		'country_id'      => $faker->numberBetween( 0, 246 ),
		'phone'           => $faker->phoneNumber,
		'gender'          => $faker->randomElement( [ 'male', 'female', 'third_gender' ] ),
		'address'         => $faker->address,
		'address_2'       => $faker->address,
		'website'         => $faker->domainName,
		'education'       => $faker->company,
		'education_title' => $faker->jobTitle,
		'inspiration'     => $faker->paragraph,
		'exhibition'      => $faker->paragraph,
		'technique'       => $faker->words( random_int( 0, 20 ) ),
		'user_type'       => $faker->randomElement( [ 'user', 'admin', 'artist', 'gallery' ] ),
		'active_status'   => $faker->randomElement( [ 0, 1, 2 ] ),
	];
} );
