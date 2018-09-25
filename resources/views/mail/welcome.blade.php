@component('mail::layout')

@slot('header')
@component('mail::header', ['url' => config('app.url')])
BeArteSpace.com
@endcomponent
@endslot

#Welcome to BeArteSpace
Hi {{ $user->first_name }}! To finish signing up, just confirm that we've got the right email.

@component('mail::button', ['url' => url('confirm-email/activate/' . $user->activation_token), 'color' => 'blue'])
Confirm Account
@endcomponent

@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

@slot('footer')
@component('mail::footer')
Copyright © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
@endcomponent
@endslot
@endcomponent