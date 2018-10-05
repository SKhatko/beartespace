<?php

namespace App\Http\Controllers;

use App\Jobs\OrderCreated;
use App\Payment;
use Illuminate\Http\Request;
use App\Order;
use App\Http\Requests;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Bus\DispatchesJobs;


class PaymentController extends Controller {

	public function index() {

		$payments = Payment::all();

		return view( 'dashboard.admin.payments', compact( 'payments' ) );
	}

	public function checkout( $transaction_id ) {

		$payment = auth()->user()->payments()->whereTransactionId( $transaction_id )->firstOrCreate( [
			'transaction_id' => $transaction_id,
		] );

		try {

			Stripe::setApiKey( config( 'services.stripe.secret' ) );

			$charge = Charge::create( [
				'amount'      => Cart::total() * 100,
				'currency'    => 'eur',
				'description' => 'Artwork Purchase',
				'source'      => $transaction_id,
//					'metadata'    => [ 'payment_id' => $payment->id ],
			] );

		} catch ( \Exception $ex ) {

			$payment->status      = 'failed';
			$payment->fail_reason = $ex->getMessage();
			$payment->save();

			// The card has been declined or any other error
			return redirect()->route( 'checkout' )->with( 'error', $ex->getMessage() );
		}

		if ( $charge->status == 'succeeded' ) {

			$payment->update( [
				'amount'             => Cart::total(),
				'status'             => 'success',
				'charge_id_or_token' => $charge->id,
				'description'        => $charge->description,
				'payment_created'    => $charge->created,
				'charge'             => serialize( $charge ),
			] );

			$payment->save();

			$order = new Order();
			$order->save();

			$order->update( [
				'user_id'    => $payment->user_id,
				'address'    => $payment->user->primaryAddress,
				'amount'     => Cart::total(),
				'payment_id' => $payment->id,
				'content'    => serialize( Cart::content() )
			] );

			OrderCreated::dispatch( $order );

			Cart::destroy();

			return view( 'checkout.success' );

		} else {
			dd( $charge );
			//				return view( 'checkout.failure', compact( 'message' ) );
		}

	}
}
