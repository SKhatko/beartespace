<?php

use Faker\Generator as Faker;

$factory->define( App\Artwork::class, function ( Faker $faker ) {
	return [
		'slug'               => $faker->slug,
		'title'              => $faker->sentence,
		'description'        => $faker->sentence,
		'inspiration'        => $faker->sentence,
		'height'             => $faker->randomFloat( 1 ),
		'width'              => $faker->randomFloat( 1 ),
		'depth'              => $faker->randomFloat( 1 ),
		'weight'             => $faker->randomFloat( 3 ),
		'date_of_completion' => $faker->date,
		'price'              => $faker->randomFloat( 2, 1, 50000 ),
		'category'           => $faker->randomElement( [ 'painting', 'sculpture' ] ),
		'medium'             => $faker->words( random_int( 0, 20 ) ),
		'direction'          => $faker->words( random_int( 0, 20 ) ),
		'theme'              => $faker->words( random_int( 0, 20 ) ),
		'color'              => $faker->words( random_int( 0, 20 ) ),
		'status'             => $faker->randomElement( [ 0, 1, 2, 3 ] ),
		'available'          => $faker->boolean,
		'quantity'           => $faker->randomDigit,
		'sold'               => $faker->boolean,
		'auction_status'     => $faker->boolean,
		'auction_price'      => $faker->randomFloat( 2 ),
		'auction_start'      => \Carbon\Carbon::now()->toDateTimeString(),
		'auction_end'        => \Carbon\Carbon::now()->toDateTimeString()
	];
} );
