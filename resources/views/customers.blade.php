<x-adminheader/>
<style>
.custom-action-btn {
  background-color: #4d8cff;      /* Light blue */
  color: black;                   /* Black text */
  border: none;                   /* Remove border */
  border-radius: 30px;            /* Pill shape */
  padding: 6px 20px;              /* Sizing */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Soft shadow */
  font-weight: 500;
}

.custom-action-btn:hover {
  background-color: #3a76e0;
  color: white;
}
.customer-details-card {
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    border-radius: 10px;
}

.customer-details-card .card-header {
    background-color: #4d8cff;
    color: white;
    border-radius: 10px 10px 0 0 !important;
}

.customer-details-card img {
    border-radius: 10px;
    max-height: 300px;
    object-fit: cover;
}

.summary-table th {
    background-color: #f8f9fa;
}
</style>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


      <!-- ========== table components start ========== -->

      <section class="table-components">

        <div class="container-fluid">

          <!-- ========== title-wrapper start ========== -->

          <div class="title-wrapper pt-30">

            <div class="row align-items-center">

              <div class="col-md-6">

                <div class="title">

                  <h2>Customer tables</h2>

                </div>

              </div>

              <!-- end col -->

              <div class="col-md-6">

                <div class="breadcrumb-wrapper">

                  <nav aria-label="breadcrumb">

                    <ol class="breadcrumb">

                      <li class="breadcrumb-item">

                        <a href="#0">Dashboard</a>

                      </li>

                      <li class="breadcrumb-item active" aria-current="page">

                        Tables

                      </li>

                    </ol>

                  </nav>

                </div>

              </div>

              <!-- end col -->

            </div>

            <!-- end row -->

          </div>

          <!-- ========== title-wrapper end ========== -->
<div class="tables-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4 border-0 shadow">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0 fw-bold text-primary">
                                <i class="lni lni-users me-2"></i>Customer Management
                            </h5>
                        </div>
                        <div class="d-flex gap-2">
                            <!-- Create Button -->
                            <button type="button" class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="lni lni-plus me-2"></i>Create Customer
                            </button>
                            
                            <!-- Export Dropdown -->
                            <div class="dropdown">
                                <button class="btn btn-success px-4 dropdown-toggle" type="button" id="exportDropdown" 
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="lni lni-download me-2"></i>Export
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="exportDropdown">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center py-2" href="{{ url('/customer/export/excel') }}">
                                            <i class="lni lni-file-excel me-2 text-success"></i>
                                            <span>Excel (CSV)</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center py-2" href="{{ url('/customer/export/pdf') }}">
                                            <i class="lni lni-file-pdf me-2 text-danger"></i>
                                            <span>PDF Document</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive rounded">
                        <table id="example" class="table table-hover align-middle mb-0" style="width:100%">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4 text-uppercase text-secondary text-xs font-weight-bolder">Image</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Name</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Email</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Phone</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Total Sale Due</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $customer)
                                <tr class="border-bottom">
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                @if($customer->image)
                                                    <img src="{{ asset('uploads/' . $customer->image) }}" alt="Customer" 
                                                         class="rounded-circle border" width="40" height="40">
                                                @else
                                                    <div class="avatar-placeholder rounded-circle bg-light text-secondary d-flex align-items-center justify-content-center" 
                                                         style="width:40px;height:40px;">
                                                        <i class="lni lni-user fs-5"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-semibold">{{ $customer->name }}</p>
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $customer->email }}" class="text-primary text-decoration-none">
                                            {{ $customer->email }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="tel:{{ $customer->phone }}" class="text-decoration-none">
                                            {{ $customer->phone }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-1 rounded-pill">
                                            {{ number_format($customer->product_price, 2) }}
                                        </span>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-primary" 
                                                    type="button" 
                                                    id="dropdownMenuButton" 
                                                    data-bs-toggle="dropdown" 
                                                    aria-expanded="false">
                                                Action
                                            </button>

                                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" 
                                                aria-labelledby="dropdownMenuButton">

                                                <!-- Details Option -->
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center gap-2"
                                                       href="{{ URL::to('/customerdetails', $customer->id) }}">
                                                        <i class="lni lni-eye text-info"></i>
                                                        <span>Customer Details</span>
                                                    </a>
                                                </li>

                                                <!-- Edit Option -->
                                                <li>
                                                    <button class="dropdown-item d-flex align-items-center gap-2 editBtn"
                                                            data-id="{{ $customer->id }}"
                                                            data-name="{{ $customer->name }}"
                                                            data-email="{{ $customer->email }}"
                                                            data-phone="{{ $customer->phone }}"
                                                            data-city="{{ $customer->city }}"
                                                            data-address="{{ $customer->address }}"
                                                            data-image="{{ $customer->image }}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editModal">
                                                        <i class="lni lni-pencil text-primary"></i>
                                                        <span>Edit</span>
                                                    </button>
                                                </li>

                                                <!-- Delete Option -->
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center gap-2 text-danger"
                                                       href="{{ URL::to('deletcustomers', $customer->id) }}" 
                                                       onclick="return confirm('Are you sure you want to delete this Customer?')">
                                                        <i class="lni lni-trash-can"></i>
                                                        <span>Delete</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

          <!-- ========== tables-wrapper end ========== -->

        </div>

        <!-- end container -->

      </section>

      <x-adminfooter/>



    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

        <div class="modal-header">

            <h5 class="modal-title" id="exampleModalLabel">Add New Record</h5>

            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>

        <form action="{{ URL::to('/addcustomers') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="modal-body">

            <div class="row gy-4">

                <div class="col-lg-6">

                <input type="text" class="form-control" name="name" placeholder="First Name" required />

                </div>

                <div class="col-lg-6">

                <input type="email" class="form-control" name="email" placeholder="Email" required />

                </div>

                <div class="col-lg-6">

                <input type="number" class="form-control" name="phone" placeholder="Phone" required />

                </div>

                

                <div class="col-lg-6">

                <input type="text" class="form-control" name="city" placeholder="city" required />

                </div>



                <div class="col-lg-6">

                <input class="form-control" type="file" name="image" id="formFile" />

                </div>

                <div class="col-lg-6">

                  <label class="form-label">Address</label>

                   <textarea class="form-control desiri derty2" name="address" required></textarea>

                </div>

            </div>

            </div>

            <div class="modal-footer">

            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            <button type="submit" class="btn btn-primary">Submit</button>

            </div>

        </form>

        </div>

    </div>

    </div>

   <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
    
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit Record</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
    
          <form action="{{ url('/updatecustomers') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="edit-id" />
    
            <div class="modal-body">
              <div class="row gy-4">
    
                <div class="col-lg-6">
                  <input type="text" class="form-control" name="name" id="edit-name" placeholder="First Name" required />
                </div>
    
                <div class="col-lg-6">
                  <input type="email" class="form-control" name="email" id="edit-email" placeholder="Email" required />
                </div>
    
                <div class="col-lg-6">
                  <input type="number" class="form-control" name="phone" id="edit-phone" placeholder="Phone" required />
                </div>
    
                <div class="col-lg-6">
                  <input type="text" class="form-control" name="city" id="edit-city" placeholder="City" required />
                </div>
    
                <div class="col-lg-6">
                  <!-- Display current image -->
                  <label>Current Image</label>
                  <img id="edit-image-preview" src="" alt="Current Image" width="100">
                </div>
    
                <div class="col-lg-6">
                  <input class="form-control" type="file" name="image" id="edit-image" />
                </div>
    
                <div class="col-lg-6">
                  <label class="form-label">Address</label>
                  <textarea class="form-control" name="address" id="edit-address" required></textarea>
                </div>
    
              </div>
            </div>
    
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
    
          </form>
        </div>
      </div>
    </div>
    <script>
       document.querySelectorAll('.editBtn').forEach(button => {
      button.addEventListener('click', () => {
          document.getElementById('edit-id').value = button.getAttribute('data-id');
          document.getElementById('edit-name').value = button.getAttribute('data-name');
          document.getElementById('edit-email').value = button.getAttribute('data-email');
          document.getElementById('edit-phone').value = button.getAttribute('data-phone');
          document.getElementById('edit-city').value = button.getAttribute('data-city');
          document.getElementById('edit-address').value = button.getAttribute('data-address');
          
          // Set the image preview in the modal
          const imagePath = button.getAttribute('data-image');
          document.getElementById('edit-image-preview').src = '{{ asset('uploads/') }}' + '/' + imagePath;

      });
  });
    </script>
   
  
    