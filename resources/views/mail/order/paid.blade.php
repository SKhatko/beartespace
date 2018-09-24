{{--<div>--}}
{{--Order id: {{ $order->id }}--}}
{{--</div>--}}

@component('mail::message')
# Hello {{ auth()->user()->name }},

# Order confirmation from {{ $order->created_at->toFormattedDateString() }}

You sent a payment of {{ $order->price }} to BeArteSpace

Click the button to see the status of your order

Your Order id {{ $order->id }}, Transaction id {{ $order->payment()->id }}


@component('mail::button', ['url' => ''])
Check order status
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
