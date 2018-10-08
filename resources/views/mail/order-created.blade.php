
@component('mail::message')

Hello {{ $order->user->name }},

##Order confirmation from **{{ $order->created_at->toFormattedDateString() }}**

You sent a payment of **{{ currency($order->amount) }}** to BeArteSpace


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
{{ $order->addressString() }}


You will be notified when your order is shipped. Click the button to check order status
@component('mail::button', ['url' => url('/dashboard/order')])
Check order status
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
