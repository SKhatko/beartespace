@component('mail::message')

Hello {{ $sale->user->name }},

Your artwork **{{ $sale->artwork->name }}** has been sold for **{{ currency($sale->price) }}** to **{{ $sale->order->user->name }}**

##Order details
@component('mail::table')
| Item       | Quantity | Price |
| :--------- |:-----:| ------:|
| {{ $sale->artwork->name }}| {{ $sale->qty }} | {{ currency($sale->price) }} |
| **Total** | {{ $sale->qty }} | {{ currency($sale->total()) }}
@endcomponent

<hr>
##Shipping address
{{ $sale->order->addressString() }}
{{--##Order confirmation from **{{ $order->created_at->toFormattedDateString() }}**--}}

{{--You sent a payment of **{{ currency($order->amount) }}** to BeArteSpace--}}

<hr>
Your profit from this sale is **{{ currency($sale->total() / 100 * 85) }}** and will be available on your balance after you customer confirms receiving the artwork.
Please confirm shipping.

@component('mail::button', ['url' => '/dashboard/order/'])
Confirm shipping of artwork
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent

