<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sale</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-table input {
            max-width: 100px;
        }
        .total-cell {
            font-weight: bold;
            vertical-align: middle;
        }
        .form-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Edit Sale</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('sales') }}">Sales</a></li>
                    <li class="breadcrumb-item active">Edit Sale</li>
                </ol>
            </nav>
        </div>

        <form action="{{ route('sale.update', $sale->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-section">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" value="{{ $sale->date }}" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Customer</label>
                        <select name="customerid" class="form-select" required>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}" {{ $sale->customerid == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Warehouse</label>
                        <select name="warehouseid" class="form-select" required>
                            @foreach ($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}" {{ $sale->warehouseid == $warehouse->id ? 'selected' : '' }}>
                                    {{ $warehouse->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="table-responsive mb-4">
                <table class="table product-table">
                    <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="productTable">
                        @foreach($sale->saledetails as $index => $detail)
                            <tr>
                                <td>
                                    {{ $detail->product_name ?? 'Unknown Product' }}
                                    <input type="hidden" name="products[{{ $index }}][id]" value="{{ $detail->productid }}">
                                </td>
                                <td>
                                    <input type="number" name="products[{{ $index }}][quantity]" 
                                           value="{{ $detail->quantity }}" class="form-control" min="1" required>
                                </td>
                                <td>
                                    <input type="number" name="products[{{ $index }}][price]" 
                                           value="{{ $detail->price }}" class="form-control" min="0" step="0.01" required>
                                </td>
                                <td class="total-cell">
                                    {{ number_format($detail->quantity * $detail->price, 2) }}
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger remove-product">
                                        Remove
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="form-section">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Order Tax</label>
                        <input type="number" name="tax" class="form-control" value="{{ $sale->tax }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Discount</label>
                        <input type="number" name="discount" class="form-control" value="{{ $sale->discount }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Shipping</label>
                        <input type="number" name="shipping" class="form-control" value="{{ $sale->shipping }}">
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">Other Details</label>
                        <textarea name="otherdetails" class="form-control" rows="2">{{ $sale->otherdetails }}</textarea>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('sales') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Sale</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Calculate row totals when quantity or price changes
        document.getElementById('productTable').addEventListener('input', function(e) {
            const input = e.target;
            if (input.name.includes('[quantity]') || input.name.includes('[price]')) {
                const row = input.closest('tr');
                const quantity = parseFloat(row.querySelector('input[name$="[quantity]"]').value) || 0;
                const price = parseFloat(row.querySelector('input[name$="[price]"]').value) || 0;
                row.querySelector('.total-cell').textContent = (quantity * price).toFixed(2);
            }
        });

        // Remove product row
        document.getElementById('productTable').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-product')) {
                e.target.closest('tr').remove();
            }
        });
    });
    </script>
</body>
</html>