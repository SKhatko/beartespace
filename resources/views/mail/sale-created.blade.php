@component('mail::message')

Hello {{ $artwork->user->name }},

Your artwork **{{ $artwork->name }}** has been sold for **{{ currency($artwork->price) }}** to **{{ $order->user->name }}**

##Order details
@foreach($order->content as $item)
<div>
{{ $item->model->name }} - {{ $item->qty }} - {{ currency($item->total()) }}

</div>

@endforeach
<hr>
##Shipping address
{{ $sale->order->addressString() }}
{{--##Order confirmation from **{{ $order->created_at->toFormattedDateString() }}**--}}

{{--You sent a payment of **{{ currency($order->amount) }}** to BeArteSpace--}}

<hr>
Your profit from this sale is **{{ currency($artwork->price / 100 * 85) }}** and will be available on your balance after you customer confirms receiving the artwork.
Please confirm shipping.

@component('mail::button', ['url' => '/dashboard/order/'])
Confirm shipping of artwork
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent

