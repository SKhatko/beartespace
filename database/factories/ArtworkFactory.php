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
		'price'              => $faker->randomFloat( 2 ),
		'category'           => $faker->randomElement( [ 'painting', 'sculpture' ] ),
		'medium'             => $faker->words( random_int( 0, 20 ) ),
		'direction'          => $faker->words( random_int( 0, 20 ) ),
		'theme'              => $faker->words( random_int( 0, 20 ) ),
		'color'              => $faker->words( random_int( 0, 20 ) ),
		'status'             => $faker->randomElement( [ 0, 1, 2, 3 ] ),
		'auction_status'     => $faker->boolean,
	];
} );