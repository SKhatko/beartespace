<?php

if ( ! function_exists( 'trans_input' ) ) {
	function trans_input( $key ) {

		$translation = trans( $key );

		if ( $key === $translation ) {
			$data      = $key;
			$whatIWant = str_after( $data, '.' );
			return title_case(str_slug($whatIWant, ' '));
		}

		return trans( $key );
	}
}

if ( ! function_exists( 'getAllTranslations' ) ) {
	function getAllTranslations() {
		$translations = [];

		$groups = \DB::table( 'language_lines' )->distinct( 'group' )->pluck( 'group' );

		foreach ( $groups as $group ) {
			$translations[ $group ] = trans( $group );
		}

		return json_encode( $translations );
	}
}

if ( ! function_exists( 'showPageContent' ) ) {
	function showPageContent( $id ) {

		$page = App\Page::find($id);

		if ( $page ) {
			return $page->content;
		} else {
			return '';
		}
	}
}

if ( ! function_exists( 'optionalPrice' ) ) {
	function optionalPrice( $price ) {

		if ( Cookie::get( 'currency' ) !== currency()->config( 'default' ) ) {
			return ' / ~ ' . currency_format( $price, Cookie::get( 'currency' ) );
		}

		return '';
	}
}

if ( ! function_exists( 'getLanguages' ) ) {
	function getLanguages() {
		$languages = \App\Language::active()->get();

		return $languages;
	}
}

function currentLanguage() {

	$language = \App\Language::whereCode( app()->getLocale() )->first();

	if ( $language ) {
		return $language;
	}

	return \App\Language::first();
}

function getCurrentCurrency() {
	if ( Cookie::get( 'currency' ) && currency()->hasCurrency( Cookie::get( 'currency' ) ) ) {
		return Cookie::get( 'currency' );
	}

	return session( 'currency' );
}

/**
 * @return bool
 */
if ( ! function_exists( 'is_rtl' ) ) {
	function is_rtl() {
		return ( currentLanguage() && currentLanguage()->is_rtl == 1 );
	}
}

if ( ! function_exists( 'paypal_ipn_verify' ) ) {
	function paypal_ipn_verify() {
		$paypal_action_url = "https://www.paypal.com/cgi-bin/webscr";
		if ( get_option( 'enable_paypal_sandbox' ) == 1 ) {
			$paypal_action_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
		}

		// STEP 1: read POST data
		// Reading POSTed data directly from $_POST causes serialization issues with array data in the POST.
		// Instead, read raw POST data from the input stream.
		$raw_post_data  = file_get_contents( 'php://input' );
		$raw_post_array = explode( '&', $raw_post_data );
		$myPost         = array();
		foreach ( $raw_post_array as $keyval ) {
			$keyval = explode( '=', $keyval );
			if ( count( $keyval ) == 2 ) {
				$myPost[ $keyval[0] ] = urldecode( $keyval[1] );
			}
		}
		// read the IPN message sent from PayPal and prepend 'cmd=_notify-validate'
		$req = 'cmd=_notify-validate';
		if ( function_exists( 'get_magic_quotes_gpc' ) ) {
			$get_magic_quotes_exists = true;
		}
		foreach ( $myPost as $key => $value ) {
			if ( $get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1 ) {
				$value = urlencode( stripslashes( $value ) );
			} else {
				$value = urlencode( $value );
			}
			$req .= "&$key=$value";
		}

		// STEP 2: POST IPN data back to PayPal to validate
		$ch = curl_init( $paypal_action_url );
		curl_setopt( $ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1 );
		curl_setopt( $ch, CURLOPT_POST, 1 );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $req );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 1 );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 2 );
		curl_setopt( $ch, CURLOPT_FORBID_REUSE, 1 );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array( 'Connection: Close' ) );

		if ( ! ( $res = curl_exec( $ch ) ) ) {
			// error_log("Got " . curl_error($ch) . " when processing IPN data");
			curl_close( $ch );
			exit;
		}
		curl_close( $ch );

		// STEP 3: Inspect IPN validation result and act accordingly
		if ( strcmp( $res, "VERIFIED" ) == 0 ) {
			return true;
		} else if ( strcmp( $res, "INVALID" ) == 0 ) {
			return false;
		}
	}
}
