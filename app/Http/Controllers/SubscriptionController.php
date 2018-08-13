<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller {

	public function updatePlan() {
		$plans = auth()->user()->plans()->get();

//		return $plans;
		return view( 'subscription.update', compact('plans'));
	}

	public function payWithStripe(Request $request) {

		return $request->all();

		$this->validate( $request, [
			'stripeEmail' => 'required|email',
			'stripeToken' => 'required',
			'plan'        => 'required'
		] );

		$plan = Plan::findOrFail($this->plan);
		$this->user()
		     ->subscription()
		     ->usingCoupon($this->coupon)
		     ->create($plan, $this->stripeToken);
	}

	public function store(Request $request)
	{

		try {
			$form->save();
		} catch (Exception $e) {
			return response()->json(
				['status' => $e->getMessage()], 422
			);
		}
		return [
			'status' => 'Success!'
		];
	}
	/**
	 * End a user's subscription.
	 *
	 * @return \RedirectResponse
	 */
	public function destroy()
	{
		auth()->user()->subscription()->cancel();
		return back();
	}

}
