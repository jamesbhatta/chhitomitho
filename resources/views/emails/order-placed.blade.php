@component('mail::message')
# Your Order has been placed

Order #{{ $order->id }}


@component('mail::panel')
<p>Hi {{ $order->user->name }} ,</p>
Your order #{{ $order->id }} has been placed on {{ \Carbon\Carbon::parse($order->created_at)->toDayDateTimeString() }} via {{ $order->payment_option == 'cod' ? 'Cash On Delivery' : $order->payment_option }}. You will be updated with another email after your item(s) has been shipped.
@endcomponent

@component('mail::table')
| Name          | Qauntity         | Price    |
|:------------- |:-------------:| --------:|
@foreach($order->orderProducts as $product)
| {{ $product->name }} | {{ $product->quantity }} | Rs. {{ $product->price }} |
@endforeach
| | Total | Rs. {{$order->total_price }} |
@endcomponent

@component('mail::button', ['url' => route('customer.orders', $order->user_id), 'color' => 'success'])
Manage your orders
@endcomponent

Thank you again for choosing us.

Regards,<br>
{{ config('app.name') }}
@endcomponent
