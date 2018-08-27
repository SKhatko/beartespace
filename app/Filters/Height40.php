<?php
/**
 * Created by PhpStorm.
 * User: skhatko
 * Date: 8/27/18
 * Time: 23:02
 */

namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Height40 implements FilterInterface{
	public function applyFilter( Image $image ) {
		return $image->heighten( 40 );
	}
}