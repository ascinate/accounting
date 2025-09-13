<!DOCTYPE html>
<html>
<head>
    <title>Products Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Products Report</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Code</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Type</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->code }}</td>
                <td>{{ $product->category }}</td>
                <td>{{ $product->brand }}</td>
                <td>{{ $product->type }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->quantity }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>