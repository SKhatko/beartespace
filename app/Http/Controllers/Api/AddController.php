<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Artwork;

class AddController extends Controller {

	public function createUserAdd( $name, $price, $period = null ) {

		$user = auth()->user();

		if ( $period === 'week' ) {
			$period = Carbon::now()->addWeek();
		} elseif ( $period === 'month' ) {
			$period = Carbon::now()->addMonth();
		} elseif ( $period === 'year' ) {
			$period = Carbon::now()->addYear();
		} else {
			$period = null;
		}

		$user->adds()->create( [
			'name'      => $name,
			'price'     => $price,
			'rebill_at' => $period,
		] );

		$user->deductFromBalance( $price );

		return [
			'status'  => 'success',
			'message' => currency( $price ) . ' deducted from your balance',
			'data'    => $user,
		];
	}


	public function createArtworkAdd( $id, $name, $price, $period = null ) {

		$artwork = Artwork::find( $id );

		$user = auth()->user();

		if ( $period === 'week' ) {
			$period = Carbon::now()->addWeek();
		} elseif ( $period === 'month' ) {
			$period = Carbon::now()->addMonth();
		} elseif ( $period === 'year' ) {
			$period = Carbon::now()->addYear();
		} else {
			$period = null;
		}

		$artwork->adds()->create( [
			'user_id' => $user->id,
			'name'       => $name,
			'price'      => $price,
			'rebill_at'  => $period,
		] );

		$user->deductFromBalance( $price );

		return [
			'status'  => 'success',
			'message' => currency( $price ) . ' deducted from your balance',
			'data'    => $artwork,
		];
	}
}
