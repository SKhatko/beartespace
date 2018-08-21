<?php

use Faker\Generator as Faker;

$factory->define( App\User::class, function ( Faker $faker ) {
	return [
		'first_name'       => $faker->firstName,
		'last_name'        => $faker->lastName,
		'email'            => $faker->unique()->safeEmail,
		'user_name'        => $faker->userName,
		'password'         => bcrypt( '123456' ),
		'gender'           => $faker->randomElement( [ 'male', 'female', 'third_gender' ] ),
		'remember_token'   => str_random( 10 ),
		'dob'              => $faker->date( $format = 'Y-m-d', $max = 'now' ),
		'country_id'       => $faker->numberBetween( 0, 246 ),
		'profession'       => $faker->word,
		'phone'            => $faker->phoneNumber,
		'address'          => $faker->address,
		'address_2'        => $faker->address,
		'education'        => $faker->company,
		'education_title'  => $faker->jobTitle,
		'inspiration'      => $faker->paragraph,
		'exhibition'       => $faker->paragraph,
		'technique'        => $faker->words( random_int( 0, 20 ) ),
		'user_type'        => $faker->randomElement( [ 'user', 'admin', 'artist', 'gallery' ] ),
		'active'           => $faker->randomElement( [ 0, 1, 2 ] ),
		'activation_token' => str_random( 60 ),
		'email_verified'   => false,
	];
} );
