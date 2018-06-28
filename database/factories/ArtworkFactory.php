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
		'year_of_completion' => $faker->year,
		'price'              => $faker->randomFloat( 2 ),
		'image'              => $faker->imageUrl,
		'category'           => json_encode( $faker->words( random_int( 0, 20 ) ) ),
		'medium'             => json_encode( $faker->words( random_int( 0, 20 ) ) ),
		'theme'              => json_encode( $faker->words( random_int( 0, 20 ) ) ),
		'color'              => json_encode( $faker->words( random_int( 0, 20 ) ) ),
		'status'             => $faker->randomElement( [ 0, 1, 2, 3 ] ),
		'auction_status'     => $faker->boolean,
	];
} );
