<?php
/**
 * Created by PhpStorm.
 * User: skhatko
 * Date: 8/3/18
 * Time: 21:12
 */

namespace App\Traits;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

trait LoginProxy {
	public function getAccessToken(Request $request) {

		$guzzle = new Client;

		$response = $guzzle->post( config( 'app.url' ) . '/oauth/token', [
			'form_params' => [
				'grant_type'    => config( 'auth.oauth.grant_type' ),
				'client_id'     => config( 'auth.oauth.client_id' ),
				'client_secret' => config( 'auth.oauth.client_secret' ),
				'username'      => $request->email,
				'password'      => $request->password,
				'scope'         => '*'
			],
			'http_errors' => false
		] );


		if($response->getStatusCode() == 200) {
			$accessToken = json_decode( (string) $response->getBody(), true )['access_token'];

			session( [ 'accessToken' => $accessToken ] );

			return true;
		}
//		else {
//			return json_decode($response->getBody()->getContents());
//		}

//		return $accessToken;

//		$accessToken = $user->createToken('access-token')->accessToken;

	}

}