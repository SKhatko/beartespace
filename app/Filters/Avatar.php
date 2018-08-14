<?php
/**
 * Created by PhpStorm.
 * User: skhatko
 * Date: 8/14/18
 * Time: 19:19
 */

namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Avatar implements FilterInterface {

	public function applyFilter( Image $image ) {
		return $image->fit( 290, 290 );
	}

}
