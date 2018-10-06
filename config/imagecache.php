<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Name of route
    |--------------------------------------------------------------------------
    |
    | Enter the routes name to enable dynamic imagecache manipulation.
    | This handle will define the first part of the URI:
    | 
    | {route}/{template}/{filename}
    | 
    | Examples: "images", "img/cache"
    |
    */
   
    'route' => 'imagecache',

    /*
    |--------------------------------------------------------------------------
    | Storage paths
    |--------------------------------------------------------------------------
    |
    | The following paths will be searched for the image filename, submited 
    | by URI. 
    | 
    | Define as many directories as you like.
    |
    */
    
    'paths' => array(
        public_path('storage'),
        public_path('images')
    ),

    /*
    |--------------------------------------------------------------------------
    | Manipulation templates
    |--------------------------------------------------------------------------
    |
    | Here you may specify your own manipulation filter templates.
    | The keys of this array will define which templates 
    | are available in the URI:
    |
    | {route}/{template}/{filename}
    |
    | The values of this array will define which filter class
    | will be applied, by its fully qualified name.
    |
    */
   
    'templates' => array(
        'small' => 'Intervention\Image\Templates\Small',
        'medium' => 'Intervention\Image\Templates\Medium',
        'large' => 'Intervention\Image\Templates\Large',
        'height-40' => 'App\Filters\Height40',
        'height-80' => 'App\Filters\Height80',
	    'height-100' => 'App\Filters\Height100',
	    'height-200' => 'App\Filters\Height200',
	    'height-500' => 'App\Filters\Height500',

	    'fit-25' => 'App\Filters\Fit25',
	    'fit-50' => 'App\Filters\Fit50',
	    'fit-75' => 'App\Filters\Fit75',
	    'fit-100' => 'App\Filters\Fit100',
	    'fit-150' => 'App\Filters\Fit150',
	    'fit-290' => 'App\Filters\Fit290',

	    'width-430' => 'App\Filters\Width430',
    ),

    /*
    |--------------------------------------------------------------------------
    | Image Cache Lifetime
    |--------------------------------------------------------------------------
    |
    | Lifetime in minutes of the images handled by the imagecache route.
    |
    */
   
    'lifetime' => 43200,

);
