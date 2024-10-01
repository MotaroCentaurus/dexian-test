<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Order Confirmation</h1>
    <p>Hi {{ $client->client_name }},</p>
    <p>Your order (ID: {{ $order->id }}) has been successfully placed.</p>
    <p>Thank you for shopping with us!</p>
</body>
</html>
