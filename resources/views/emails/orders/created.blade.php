<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">
    <h2>Hello {{ $order->user->name }},</h2>
    <p>Thank you for your order! We have received your request and are processing it.</p>
    
    <h3>Order Details</h3>
    <p><strong>Order ID:</strong> #{{ $order->id }}</p>
    <p><strong>Total Amount:</strong> {{ $order->currency }} {{ number_format($order->total_amount, 2) }}</p>
    
    <h3>Items</h3>
    <ul>
        @foreach ($order->items as $item)
            <li>{{ $item->description }} - (x{{ $item->quantity }})</li>
        @endforeach
    </ul>
    
    <p>You can view your order status in your <a href="{{ route('client.orders.show', $order->id) }}">dashboard</a>.</p>
    
    <p>Best regards,<br>MyCompany Team</p>
</body>
</html>
