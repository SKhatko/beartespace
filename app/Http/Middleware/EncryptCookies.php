<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as BaseEncrypter;

class EncryptCookies extends BaseEncrypter {
	/**
	 * The names of the cookies that should not be encrypted.
	 *
	 * @var array
	 */
	// TODO remove it, it's a workaround bug in laravel 5.6.30
	protected static $serialize = true;

	protected $except = [
		//
	];
}
