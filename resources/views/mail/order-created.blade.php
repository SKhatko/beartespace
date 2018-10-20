
@component('mail::message')

Dear {{ $order->user->name }},

##This is your reservation confirmation from **{{ $order->created_at->toFormattedDateString() }}**

You sent a payment of **{{ currency($order->amount) }}** to BeArteSpace, which we have received on behalf of artist.

##Order content
@component('mail::table')
| Item       | Quantity   | Price |
| :--------- |:-----:| ------:|
@foreach($order->content as $item)
| {{ $item->name }}| {{ $item->qty }} | {{ currency($item->price) }} |
@endforeach
| **Total** | {{ $order->content->count() }} | {{ currency($order->amount) }}
@endcomponent

##Shipping address
{!! $order->addressString() !!}

We have informed the artist about your reservation of the artwork. Soon he will confirm date of shipping, which we will pass to you.

When the artwork has been shipped, you will be notified in a separate mail, which will also include your invoice and a Track & Trace number, so you can follow your shipment.

Click the button to check order status
@component('mail::button', ['url' => url('/dashboard/order')])
Check order status
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
