{{--<div>--}}
{{--Order id: {{ $order->id }}--}}
{{--</div>--}}

@component('mail::message')

Hello {{ auth()->user()->name }},

##Order confirmation from **{{ $order->created_at->toFormattedDateString() }}**

You sent a payment of **{{ currency($order->amount) }}** to BeArteSpace

##Shipping address
{{ $order->addressString() }}


You will be notified when your order is shipped. Click the button to check order status
@component('mail::button', ['url' => '/dashboard/order'])
Check order status
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
