<x-adminheader/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Customer Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ asset('uploads/' . $customer->image) }}" alt="Customer Image" class="img-fluid">
                        </div>
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $customer->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $customer->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $customer->phone }}</td>
                                </tr>
                                <tr>
                                    <th>City</th>
                                    <td>{{ $customer->city }}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{ $customer->address }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h4>Sales Summary</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Total Sales</th>
                                    <td>{{ $salesData->total_sales }}</td>
                                </tr>
                                <tr>
                                    <th>Total Amount</th>
                                    <td>{{ number_format($salesData->total_amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Total Paid</th>
                                    <td>{{ number_format($salesData->total_paid, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Total Debt</th>
                                    <td>{{ number_format($salesData->total_debt, 2) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ URL::to('/customers') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
<x-adminfooter/>