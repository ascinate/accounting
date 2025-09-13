<x-adminheader/>

<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 text-primary">
                <i class="bi bi-building me-2"></i>Supplier Details
            </h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ URL::to('/suppliers') }}">Suppliers</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Details</li>
                </ol>
            </nav>
        </div>
        <a href="{{ URL::to('/suppliers') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Back to List
        </a>
    </div>

    <!-- Supplier Profile Section -->
    <div class="row mb-4">
        <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="position-relative d-inline-block mb-3">
                        {{-- <div class="avatar-placeholder rounded-circle bg-light text-secondary d-flex align-items-center justify-content-center" 
                             style="width: 180px; height: 180px; border: 3px solid #4d8cff;">
                            <i class="bi bi-building fs-1"></i>
                        </div> --}}
                        {{-- <span class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-2">
                            <i class="bi bi-check-lg"></i>
                        </span> --}}
                    </div>
                    <h4 class="mb-1">{{ $supplier->name }}</h4>
                    <p class="text-muted mb-3">Supplier since: {{ date('M Y', strtotime($supplier->created_at)) }}</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="mailto:{{ $supplier->email }}" class="btn btn-sm btn-outline-primary rounded-pill">
                            <i class="bi bi-envelope me-1"></i>Email
                        </a>
                        <a href="tel:{{ $supplier->phone }}" class="btn btn-sm btn-outline-success rounded-pill">
                            <i class="bi bi-telephone me-1"></i>Call
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-8">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title border-bottom pb-3 mb-4">
                        <i class="bi bi-info-circle me-2"></i>Contact Information
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded">
                                <h6 class="text-muted mb-2">
                                    <i class="bi bi-building me-2"></i>Company Name
                                </h6>
                                <p class="mb-0 fs-5">{{ $supplier->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded">
                                <h6 class="text-muted mb-2">
                                    <i class="bi bi-envelope me-2"></i>Email
                                </h6>
                                <p class="mb-0 fs-5">{{ $supplier->email }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded">
                                <h6 class="text-muted mb-2">
                                    <i class="bi bi-telephone me-2"></i>Phone
                                </h6>
                                <p class="mb-0 fs-5">{{ $supplier->phone }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded">
                                <h6 class="text-muted mb-2">
                                    <i class="bi bi-geo-alt me-2"></i>City
                                </h6>
                                <p class="mb-0 fs-5">{{ $supplier->city }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded">
                                <h6 class="text-muted mb-2">
                                    <i class="bi bi-globe me-2"></i>Country
                                </h6>
                                <p class="mb-0 fs-5">{{ $supplier->country }}</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="p-3 bg-light rounded">
                                <h6 class="text-muted mb-2">
                                    <i class="bi bi-house-door me-2"></i>Address
                                </h6>
                                <p class="mb-0 fs-5">{{ $supplier->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Purchases Summary Section -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">
                <i class="bi bi-cart-check me-2"></i>Purchases Summary
            </h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-3 col-sm-6">
                    <div class="card border-primary border-2 h-100">
                        <div class="card-body text-center py-4">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="bi bi-cart-check fs-4 text-primary"></i>
                            </div>
                            <h6 class="text-muted mb-2">Total Purchases</h6>
                            <h3 class="text-primary mb-0">{{ $purchaseData->total_purchases }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card border-success border-2 h-100">
                        <div class="card-body text-center py-4">
                            <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="bi bi-currency-dollar fs-4 text-success"></i>
                            </div>
                            <h6 class="text-muted mb-2">Total Amount</h6>
                            <h3 class="text-success mb-0">${{ number_format($purchaseData->total_amount, 2) }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card border-info border-2 h-100">
                        <div class="card-body text-center py-4">
                            <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="bi bi-cash-coin fs-4 text-info"></i>
                            </div>
                            <h6 class="text-muted mb-2">Total Paid</h6>
                            <h3 class="text-info mb-0">${{ number_format($purchaseData->total_paid, 2) }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card border-warning border-2 h-100">
                        <div class="card-body text-center py-4">
                            <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="bi bi-exclamation-triangle fs-4 text-warning"></i>
                            </div>
                            <h6 class="text-muted mb-2">Total Debt</h6>
                            <h3 class="text-warning mb-0">${{ number_format($purchaseData->total_debt, 2) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card-footer text-end">
        <a href="{{ URL::to('/suppliers') }}" class="btn btn-secondary me-2">
            <i class="bi bi-arrow-left me-1"></i>Back
        </a>
        <button class="btn btn-primary">
            <i class="bi bi-printer me-1"></i>Print
        </button>
    </div>
</div>

<x-adminfooter/>