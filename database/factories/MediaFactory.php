<?php

use Faker\Generator as Faker;

$factory->define( App\Media::class, function ( Faker $faker ) {
	return [
		'original_name' => $faker->image(null, null, null, null, false),
		'name'       => $faker->image(null, null, null, null, false),
		'slug'       => $faker->slug,
		'url'        => 'https://picsum.photos/' . random_int(500, 1920) . '/' . random_int(500, 1920),
		'folder'     => '',
	];
} );
