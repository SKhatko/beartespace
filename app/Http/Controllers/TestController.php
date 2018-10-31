<?php

namespace App\Http\Controllers;

use App\Notifications\SignupActivate;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;

class TestController extends Controller {

	public function testAuth() {
		$user = User::where('email', 's.a.hatko@gmail.com')->firstOrFail();

		$user->notify( new SignupActivate( $user ) );

		return 'pass';
	}

	public function testAuthView() {
		$user = User::where('email', 's.a.hatko@gmail.com')->firstOrFail();

		return (new MailMessage)
			->subject('Confirm your account')
			->markdown('mail.welcome', ['user' => $user]);
//		    ->line('Thanks for signup! Please before you begin, you must confirm your account.')
//		    ->action('Confirm Account', url('/api/register/activate/'.$notifiable->activation_token))
//		    ->line('Thank you for using our application!');


		dd( new SignupActivate( $user ));
	}
}
