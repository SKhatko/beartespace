<?php
/**
 * Created by PhpStorm.
 * User: skhatko
 * Date: 8/14/18
 * Time: 23:41
 */

namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Fit50 implements FilterInterface {
	public function applyFilter( Image $image ) {
		return $image->fit( 50, 50 );
	}
}
