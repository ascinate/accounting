<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sale PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h2 {
            text-align: center;
        }
        .info {
            margin-bottom: 20px;
        }
        .info p {
            margin: 4px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 8px 12px;
            border: 1px solid #444;
        }
        th {
            background: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2>Sale Receipt</h2>

    <div class="info">
        <p><strong>Sale ID:</strong> {{ $sale->id }}</p>
        <p><strong>Product Name:</strong> {{ $sale->product_name }}</p>
        <p><strong>Status:</strong> {{ ucfirst($sale->status) }}</p>
        <p><strong>Total Amount:</strong> {{ number_format($sale->amount, 2) }}</p>
       
    </div>

</body>
</html>
