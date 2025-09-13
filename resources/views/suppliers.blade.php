<x-adminheader/>

      <section class="table-components">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
               <div class="title-wrapper pt-30">
                  <div class="row align-items-center">
                     <div class="col-md-6">
                        <div class="title">
                               <h2>Tables</h2>
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



          <!-- ========== tables-wrapper start datatable ========== -->
<div class="tables-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4 border-0 shadow">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0 fw-bold text-primary">
                                <i class="lni lni-users me-2"></i>Supplier Management
                            </h5>
                        </div>
                        <div class="d-flex gap-2">
                            <!-- Create Button -->
                            <button type="button" class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#supplierModal">
                                <i class="lni lni-plus me-2"></i>Create Supplier
                            </button>
                            
                            <!-- Export Dropdown -->
                            <div class="dropdown">
                                <button class="btn btn-success px-4 dropdown-toggle" type="button" id="exportDropdown" 
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="lni lni-download me-2"></i>Export
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="exportDropdown">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center py-2" href="{{ url('/supplier/export/excel') }}">
                                            <i class="lni lni-file-excel me-2 text-success"></i>
                                            <span>Excel (CSV)</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center py-2" href="{{ url('/supplier/export/pdf') }}">
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
                                    <th class="ps-4 text-uppercase text-secondary text-xs font-weight-bolder">Name</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Email</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Phone</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Address</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($suppliers as $supplier)
                                <tr class="border-bottom">
                                    <td class="ps-4">
                                        <p class="mb-0 fw-semibold">{{ $supplier->name }}</p>
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $supplier->email }}" class="text-primary text-decoration-none">
                                            {{ $supplier->email }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="tel:{{ $supplier->phone }}" class="text-decoration-none">
                                            {{ $supplier->phone }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $supplier->address }}
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
                                                       href="{{ URL::to('/supplierdetails', $supplier->id) }}">
                                                        <i class="lni lni-eye text-info"></i>
                                                        <span>View Supplier</span>
                                                    </a>
                                                </li>

                                                <!-- Edit Option -->
                                                <li>
                                                    <button class="dropdown-item d-flex align-items-center gap-2 editBtn"
                                                            data-id="{{ $supplier->id }}"
                                                            data-name="{{ $supplier->name }}"
                                                            data-email="{{ $supplier->email }}"
                                                            data-phone="{{ $supplier->phone }}"
                                                            data-city="{{ $supplier->city }}"
                                                            data-country="{{ $supplier->country }}"
                                                            data-address="{{ $supplier->address }}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editSupplierModal">
                                                        <i class="lni lni-pencil text-primary"></i>
                                                        <span>Edit Supplier</span>
                                                    </button>
                                                </li>

                                                <!-- Delete Option -->
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center gap-2 text-danger"
                                                       href="{{ URL::to('deletesuppliers', $supplier->id) }}" 
                                                       onclick="return confirm('Are you sure you want to delete this supplier?')">
                                                        <i class="lni lni-trash-can"></i>
                                                        <span>Delete Supplier</span>
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

        <form action="{{ URL::to('/addsuppliers') }}" method="POST" enctype="multipart/form-data">

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

                <input class="form-control" type="text" name="country" id="country" placeholder="country" required/>

                </div>

                <div class="col-lg-6">

                  

                   <input class="form-control" type="text" name="address" id="address" placeholder="address" required/>

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



    <div class="modal fade" id="editSupplierModal" tabindex="-1" aria-labelledby="editSupplierLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="editSupplierLabel">Edit Supplier</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="{{ URL::to('/updatesuppliers') }}" method="POST">
        @csrf
        <input type="hidden" name="id" id="edit-id">

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
              <input type="text" class="form-control" name="country" id="edit-country" placeholder="Country" required />
            </div>
            <div class="col-lg-6">
              <input type="text" class="form-control" name="address" id="edit-address" placeholder="Address" required />
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
    button.addEventListener('click', function () {
      document.getElementById('edit-id').value = this.getAttribute('data-id');
      document.getElementById('edit-name').value = this.getAttribute('data-name');
      document.getElementById('edit-email').value = this.getAttribute('data-email');
      document.getElementById('edit-phone').value = this.getAttribute('data-phone');
      document.getElementById('edit-city').value = this.getAttribute('data-city');
      document.getElementById('edit-country').value = this.getAttribute('data-country');
      document.getElementById('edit-address').value = this.getAttribute('data-address');
    });
  });
</script>
