@component('mail::layout')

@slot('header')
@component('mail::header', ['url' => config('app.url')])
BeArteSpace.com
@endcomponent
@endslot

#Welcome to BeArteSpace
Thanks for signup! Please before you begin, you must confirm your account.

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
    © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    @endcomponent
    @endslot
@endcomponent