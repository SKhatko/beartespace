<?php

use Faker\Generator as Faker;

$factory->define( \App\Article::class, function ( Faker $faker ) {
	return [
		'name'     => $faker->sentence,
		'content'  => $faker->paragraphs( 10, true ),
		'category' => $faker->word,
		'slug'     => $faker->slug,
		'active'   => $faker->boolean,
		'tags'     => $faker->words( random_int( 0, 5 ) )
	];
} );
