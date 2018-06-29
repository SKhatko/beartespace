<?php

use Faker\Generator as Faker;

$factory->define( App\Media::class, function ( Faker $faker ) {
	return [
		'user_id'    => '',
		'artwork_id' => '',
		'name'       => 'http://lorempixel.com/' . random_int(1, 1920) . '/' . random_int(1, 1920) . '/nature',
		'slug'       => $faker->slug,
		'url'        => '',
		'folder'     => '',
	];
} );
