<?php

namespace App;

use Laravel\Socialite\Contracts\User as ProviderUser;
use Laravel\Socialite\Facades\Socialite;

class SocialAccountService {
	public function createOrGetFBUser( ProviderUser $providerUser ) {
		$account = SocialAccount::whereProvider( 'facebook' )->whereProviderUserId( $providerUser->getId() )->first();

		if ( $account ) {
			if ( ! $account->user ) {
				$account->delete();
			}

			return $account->user;
		} else {
			$account = new SocialAccount( [
				'provider_user_id' => $providerUser->getId(),
				'provider'         => 'facebook'
			] );

			$user = User::whereEmail( $providerUser->getEmail() )->first();

			if ( ! $user ) {
				$user = User::create( [
					'email'          => $providerUser->getEmail(),
					'name'           => $providerUser->getName(),
					'email_verified' => true,
					'role'      => 'user',
				] );
			}
			$account->user()->associate( $user );
			$account->save();

			return $user;
		}
	}


	public function createOrGetGoogleUser( ProviderUser $providerUser ) {
		$account = SocialAccount::whereProvider( 'google' )->whereProviderUserId( $providerUser->getId() )->first();
		if ( $account ) {
			if ( ! $account->user ) {
				$account->delete();
			}

			return $account->user;
		} else {
			$account = new SocialAccount( [
				'provider_user_id' => $providerUser->getId(),
				'provider'         => 'google'
			] );

			$user = User::whereEmail( $providerUser->getEmail() )->first();

			if ( ! $user ) {
				$user = User::create( [
					'email'          => $providerUser->getEmail(),
					'name'           => $providerUser->getName(),
					'email_verified' => true,
					'role'      => 'user',
				] );
			}

			$account->user()->associate( $user );
			$account->save();

			return $user;
		}
	}

	public function createOrGetTwitterUser( ProviderUser $providerUser ) {
		$account = SocialAccount::whereProvider( 'twitter' )->whereProviderUserId( $providerUser->getId() )->first();
		if ( $account ) {
			if ( ! $account->user ) {
				//Delete social table account if user is not exists
				$account->delete();
			}

			return $account->user;
		} else {
			$account = new SocialAccount( [
				'provider_user_id' => $providerUser->getId(),
				'provider'         => 'twitter'
			] );

			$user = User::whereEmail( $providerUser->getEmail() )->first();

			if ( ! $user ) {
				$user = User::create( [
					'email'          => $providerUser->getEmail(),
					'name'           => $providerUser->getName(),
					'email_verified' => true,
					'role'      => 'user',
				] );
			}

			$account->user()->associate( $user );
			$account->save();

			return $user;
		}
	}

}