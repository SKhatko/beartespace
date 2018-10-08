<?php

namespace App\Http\Controllers;

use App\Jobs\OrderCreated;
use App\Order;
use App\Sale;
use Illuminate\Http\Request;
use Braintree\ClientToken;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartCheckoutController extends Controller {
	public function shipping() {

		$user = auth()->user();

		return view( 'cart.shipping', compact( 'user' ) );
	}

	public function setPrimaryShippingAddress( $id ) {

		$user = auth()->user();

		$address = $user->addresses()->where( 'addresses.id', $id )->firstOrFail();

		$user->primaryAddress()->associate( $address );

		$user->save();

		return redirect( route( 'cart.checkout' ) );
	}

	public function payment() {

		$user = auth()->user();

		if ( $user->hasBraintreeId() ) {
			$clientToken = ClientToken::generate( [ 'customerId' => $user->braintree_id ] );
		} else {
			// TODO move to .env
			$clientToken = 'sandbox_9qqqx29m_8zf5jpxstv3pkjwy';
		}

		return view( 'cart.payment', compact( 'clientToken' ) );
	}


	public function savePaymentMethod( Request $request ) {

		$request->validate( [
			'payment' => 'required',
		] );

		$nonce = $request->input( 'payment' );

		$user = auth()->user();

		if ( $user->hasBraintreeId() ) {
			$user->updateCard( $nonce );
		} else {
			$user->createAsBraintreeCustomer( $nonce );
		}

		return redirect()->route( 'cart.checkout' );
	}

	public function checkout() {

		$user = auth()->user();


//		$payment = $user->payments()->create();
//		$payment->save();
//		$order = $user->orders()->create();
//		$order->save();
//
//		$payment->order()->associate($order);
//		$payment->save();
//
//		$payment->order()->update([
//			'address'    => $user->primaryAddress,
//			'content'    => serialize( Cart::content() ),
//			'amount'     => Cart::total(),
//		] );
//
//		$order->fresh();


		$address       = $user->primaryAddress;
		$paymentMethod = $user->paymentMethod();

//		return $paymentMethod;
		return view( 'cart.checkout', compact( 'address', 'paymentMethod' ) );
	}

	public function checkoutPost( Request $request ) {

		$user = auth()->user();

		$payment = $user->payments()->create();
		$payment->save();

		try {
			$charge = $user->charge( Cart::total() );
		} catch ( \Exception $err ) {
			$message = $err->getMessage();
			$payment->update( [
				'status' => $message
			] );

			return redirect()->route( 'cart.checkout' )->with( 'inline-error', $message );
		}

		$payment->update( [
			'transaction_id' => $charge->transaction->id,
			'amount'         => $charge->transaction->amount,
			'transaction'    => serialize( $charge->transaction ),
			'status'         => $charge->transaction->status
		] );

		$order = $user->orders()->create();
		$order->save();

		$payment->order()->associate( $order );
		$payment->save();

		$payment->order()->update( [
			'address' => $user->primaryAddress,
			'content' => serialize( Cart::content() ),
			'amount'  => Cart::total(),
		] );

		$order = Order::findOrFail( $payment->order->id );

		if ( $order ) {

			foreach ( $order->content as $item ) {

				$order->sales()->create([
					'user_id'    => $item->model->user_id,
					'artwork_id' => $item->id,
					'qty'        => $item->qty,
					'price'      => $item->price,
				]);

			}

			OrderCreated::dispatch( $order );

			Cart::destroy();

		} else {

			return redirect()->route( 'cart.checkout.failure' );
		}

		return redirect()->route( 'cart.checkout.success' );

	}

	public function checkoutSuccess() {
		return view( 'cart.checkout-success' );
	}

	public function checkoutFailure() {
		return view( 'cart.checkout-failure' );
	}
}
