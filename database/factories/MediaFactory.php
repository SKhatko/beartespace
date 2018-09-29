<?php

use Faker\Generator as Faker;

$factory->define( App\Media::class, function ( Faker $faker ) {
	$imageName = $faker->randomElement(['1.jpg','2.jpg', '3.jpg']);
	return [
		'original_name' => $imageName,
		'name'       => $imageName,
		'slug'       => str_slug($imageName),
		'url'        => null,
		'folder'     => '',
	];
//	return [
//		'original_name' => $faker->image(null, null, null, null, false),
//		'name'       => $faker->image(null, null, null, null, false),
//		'slug'       => $faker->slug,
//		'url'        => 'https://picsum.photos/' . random_int(500, 1920) . '/' . random_int(500, 1920),
//		'folder'     => '',
//	];
} );
