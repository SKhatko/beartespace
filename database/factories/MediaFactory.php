<?php

use Faker\Generator as Faker;

$factory->define( App\Media::class, function ( Faker $faker ) {
	return [
		'user_id'    => '',
		'artwork_id' => '',
		'name'       => 'https://picsum.photos/' . random_int(1, 1920) . '/' . random_int(1, 1920),
		'slug'       => $faker->slug,
		'url'        => '',
		'folder'     => '',
	];
} );
