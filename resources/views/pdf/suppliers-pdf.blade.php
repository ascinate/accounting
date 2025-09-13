<!DOCTYPE html>
<html>
<head>
    <title>Suppliers Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 20px; }
        .footer { margin-top: 20px; text-align: right; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Suppliers Report</h2>
        <p>Generated on: {{ date('Y-m-d H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>City</th>
                <th>Country</th>
                <th>Total Purchases</th>
                <th>Total Amount</th>
                <th>Total Paid</th>
                <th>Total Debt</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suppliers as $supplier)
            <tr>
                <td>{{ $supplier->name }}</td>
                <td>{{ $supplier->email }}</td>
                <td>{{ $supplier->phone }}</td>
                <td>{{ $supplier->city }}</td>
                <td>{{ $supplier->country }}</td>
                <td>{{ $supplier->total_purchases }}</td>
                <td>{{ number_format($supplier->total_amount, 2) }}</td>
                <td>{{ number_format($supplier->total_paid, 2) }}</td>
                <td>{{ number_format($supplier->total_debt, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>© {{ date('Y') }} Your Company Name. All rights reserved.</p>
    </div>
</body>
</html>