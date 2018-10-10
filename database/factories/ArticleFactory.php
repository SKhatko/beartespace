<?php

use Faker\Generator as Faker;

$factory->define( \App\Article::class, function ( Faker $faker ) {
	return [
		'name'   => $faker->sentence,
		'content' => $faker->sentence,
		'slug'    => $faker->slug,
		'active'  => $faker->boolean
	];
} );
