<!DOCTYPE html>
<html>
<head>
    <title>Customers List</title>
    <style>
        body { 
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px;
            table-layout: fixed;
            word-wrap: break-word;
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 6px; 
            text-align: left; 
            vertical-align: top;
        }
        th { 
            background-color: #f2f2f2; 
            font-weight: bold;
        }
        .text-right { 
            text-align: right; 
        }
        .text-center { 
            text-align: center; 
        }
        h1 {
            font-size: 18px;
            margin-bottom: 10px;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <h1>Customers List - {{ date('Y-m-d') }}</h1>
    <table>
        <thead>
            <tr>
                <th width="15%">Name</th>
                <th width="20%">Email</th>
                <th width="12%">Phone</th>
                <th width="15%">City</th>
                <th width="8%" class="text-center">Total Sales</th>
                <th width="10%" class="text-right">Total Amount</th>
                <th width="10%" class="text-right">Total Paid</th>
                <th width="10%" class="text-right">Total Debt</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->phone }}</td>
                <td>{{ $customer->city }}</td>
                <td class="text-center">{{ $customer->total_sales }}</td>
                <td class="text-right">{{ number_format($customer->total_amount, 2) }}</td>
                <td class="text-right">{{ number_format($customer->total_paid, 2) }}</td>
                <td class="text-right">{{ number_format($customer->total_debt, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>