<x-adminheader/>

      <section class="table-components">

        <div class="container-fluid">

          <!-- ========== title-wrapper start ========== -->

          <div class="title-wrapper pt-30">

            <div class="row align-items-center">

              <div class="col-md-6">

                <div class="title">

                  <h2>Adjustment Tables</h2>

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

            <!-- edit modal starts here -->
      
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Update Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" action="#" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="id" id="edit_id">
                <div class="modal-body">
                    <div class="row gy-4">
                        <div class="col-lg-6">
                            <select name="warehouse" id="edit_warehouse" class="form-control" required>
                            <option value="" id="edit" ></option>
                                <option value="">--- Choose Warehouse ---</option>
                                @foreach ($warehouses as $warehouse)
                                    <option value="{{ $warehouse->id }}" >{{ $warehouse->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <input type="number" name="quantity" id="edit_quantity" class="form-control" required>
                        </div>

                        <div class="col-lg-12">
                            <textarea name="details" id="edit_details" class="form-control" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>



 <!-- edit modal ends here -->

 <script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll("[data-bs-target='#editModal']").forEach(button => {
            button.addEventListener("click", function () {
                let id = this.getAttribute("data-id");
                let warehouse = this.getAttribute("data-warehouse");
                let quantity = this.getAttribute("data-quantity");
                let details = this.getAttribute("data-details");
              
                document.getElementById("edit_id").value = id;
                document.getElementById("edit").innerHTML = warehouse;
                document.getElementById("edit_quantity").value = quantity;
                document.getElementById("edit_details").value = details;

                // Set the form action dynamically
                document.getElementById("editForm").action = "adjustments/update/" + id;
            });
        });
    });
</script>
          <!-- ========== tables-wrapper start datatable ========== -->

          <div class="tables-wrapper">

            <div class="row">

              <div class="col-lg-12">

              @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                <div class="card-style mb-30">

                  <div class="d-flex align-items-center w-100 justify-content-between">

                      <div class="ledt-divtyu">

                        <h6 class="mb-10">User list</h6>

                        <p class="text-sm mb-20">

                          For basic styling—light padding and only horizontal

                          dividers—use the class table.

                        </p>

                      </div>

                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"> Create </button>

                  </div>

                 
                     
                    <table id="example" class="table-wrapper table table-striped nowrap" style="width:100%">

                      <thead>

                        <tr>

                          <th class="lead-info">

                            <h6>Date</h6>

                          </th>

                          <th class="lead-email">

                            <h6>Ref</h6>

                          </th>
                           <th class="lead-info">

                            <h6>Warehouse</h6>

                          </th>

                          <th class="lead-email">

                            <h6>Total Products</h6>

                          </th>

                          

                          <th>

                            <h6>Action</h6>

                          </th>

                        </tr>

                        <!-- end table row-->

                      </thead>

                      <tbody>

                      @foreach($adjustment as $adjustment)

                        <tr>

                          <td class="min-width">

                            <div class="lead">

                             

                              <div class="lead-text">

                              <p><a href="#0">{{ $adjustment->date }}</a></p>

                              </div>

                            </div>

                          </td>

                          <td class="min-width">

                            <p><a href="#0">{{ $adjustment->ref_id }}</a></p>

                          </td>

                           <td class="min-width">

                            <p><a href="#0">{{ $adjustment->warehouse_id }}</a></p>

                          </td>

                           <td class="min-width">

                            <p><a href="#0">{{ $adjustment->total_products }}</a></p>

                          </td>

                          <td class="min-width">

                            <div class="action">

                            <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#editModal"
                            data-id="{{ $adjustment->id }}"
                            data-warehouse="{{ $adjustment->warehouse_id }}"
                            data-quantity="{{ $adjustment->total_products }}"
                            data-details="{{ $adjustment->details }}">
                              <i class="lni lni-pencil"></i>
                          </a>
                           &nbsp;
                           
                            <a href="{{ url('deleteadjustment', $adjustment->id) }}" class="text-danger"  onclick="return confirm('Are you sure you want to delete this adjustment?')">
                                <i class="lni lni-trash-can"></i>
                            </a>
                          </form>

                            </div>

                          </td>

                        </tr>

                    

                        @endforeach

           

                      </tbody>

                    </table>

                    <!-- end table -->

                 

                </div>

                <!-- end card -->

              </div>

              <!-- end col -->

            </div>

            <!-- end row -->



            

            <!-- end row -->

          </div>

          <!-- ========== tables-wrapper end ========== -->

        </div>

        <!-- end container -->

      </section>

      <!-- ========== table components end ========== -->



      <!-- ========== footer start =========== -->

      <x-adminfooter/>
      <!-- ========== footer end =========== -->

 

  



<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('adjustments.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row gy-4">
                        <div class="col-lg-6">
                            <select name="warehouse" class="form-control" required>
                                <option value="" selected>--- Choose Warehouse ---</option>
                                @foreach ($warehouses as $warehouse)
                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <input type="number" name="quantity" placeholder="Product Quantity" class="form-control" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                            <input type="text" id="productSearch" class="form-control" placeholder="Scan/Search Product by code or name">
                            
                        </div>
                        <div class="input-group mb-3">
                      
                        <ul id="productDropdown" class="dropdown-menu w-100"></ul>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Code</th>
                                        <th>Product Name</th>
                                        <th>Current Stock</th>
                                        <th>Qty</th>
                                        <th>Type</th>
                                    </tr>
                                </thead>
                                <tbody id="productTable">
                                    <tr>
                                        <td colspan="6" class="text-center">No data available</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-12">
                            <textarea name="details" class="form-control" required>Details</textarea>
                        </div>
                        <input type="hidden" name="product_id" id="product_id">
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












