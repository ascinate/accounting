<!DOCTYPE html>
<html>
<head>
    <title>Purchase Receipt</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        h2 { text-align: center; }
        .info p { margin: 4px 0; }
    </style>
</head>
<body>
    <h2>Purchase Receipt</h2>
    <div class="info">
        <p><strong>Purchase ID:</strong> {{ $purchase->id }}</p>
        <p><strong>Product Name:</strong> {{ $purchase->product_name }}</p>
        <p><strong>Quantity:</strong> {{ $purchase->quantity }}</p>
        <p><strong>Price:</strong> {{ number_format($purchase->price, 2) }}</p>
        <p><strong>Total Amount:</strong> {{ number_format($purchase->amount, 2) }}</p>
        <p><strong>Tax:</strong> {{ number_format($purchase->tax, 2) }}</p>
        <p><strong>Discount:</strong> {{ number_format($purchase->discount, 2) }}</p>
        <p><strong>Shipping:</strong> {{ number_format($purchase->shipping, 2) }}</p>
        <p><strong>Other Details:</strong> {{ $purchase->other_details }}</p>
    </div>
</body>
</html>

