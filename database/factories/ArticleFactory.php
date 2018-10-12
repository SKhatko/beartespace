<?php

use Faker\Generator as Faker;

$factory->define( \App\Article::class, function ( Faker $faker ) {
	return [
		'name'   => $faker->sentence,
		'content' => $faker->paragraphs(10, true),
		'slug'    => $faker->slug,
		'active'  => $faker->boolean
	];
} );
