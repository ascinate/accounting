<x-adminheader/>

<style>
.action-btn {
    border-radius: 6px;
    padding: 4px 12px;
    font-size: 14px;
    font-weight: 500;
    background-color: #f5f9ff;
    color: #0d6efd;
    border: 1px solid #0d6efd;
    transition: all 0.2s ease-in-out;
}

.action-btn:hover {
    background-color: #0d6efd;
    color: white;
}
</style>

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

                

                <div class="card-style mb-30">

                  <div class="d-flex align-items-center w-100 justify-content-between">

                      <div class="ledt-divtyu">

                        <h6 class="mb-10">Product list</h6>

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

                          <th class="lead-info">

                            <h6>Supllier</h6>

                          </th>

                          <th class="lead-email">

                            <h6>Warehouse</h6>

                          </th>

                          <th class="lead-phone">

                            <h6>Tax</h6>

                          </th>

                          

                          <th>

                            <h6>Action</h6>

                          </th>

                        </tr>

                        <!-- end table row-->

                      </thead>

                      <tbody>

                      @foreach($quotations as $quotation)

                        <tr>

                          <td class="min-width">

                            <div class="lead">

                             

                              <div class="lead-text">

                              <p><a href="#0">{{ $quotation->date }}</a></p>

                              </div>

                            </div>

                          </td>

                          <td class="min-width">

                          <p>{{ $quotation->customer_name ?? 'No Customer' }}</p>

                          </td>

                         

                          <td class="min-width">

                          <p>{{ $quotation->warehouse_name ?? 'No Warehouse' }}</p>

                          </td>



                          <td class="min-width">

                            <p>{{ $quotation->tax }}</p>

                          </td>

                         

                          <td>
    <div class="dropdown">
        <button class="btn btn-sm btn-secondary dropdown-toggle action-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Actions
        </button>
        <ul class="dropdown-menu">
            <li>
                <button 
                    type="button" 
                    class="dropdown-item edit-quotation-btn"
                    data-id="{{ $quotation->id }}"
                    data-date="{{ $quotation->date }}"
                    data-customer="{{ $quotation->customer_id }}"
                    data-warehouse="{{ $quotation->warehouse_id }}"
                    data-tax="{{ $quotation->tax }}"
                    data-discount="{{ $quotation->discount }}"
                    data-shipping="{{ $quotation->shipping }}"
                    data-otherdetails="{{ $quotation->otherdetails }}"
                    data-bs-toggle="modal"
                    data-bs-target="#editQuotationModal">
                    Edit
                </button>
            </li>
            <li>
                <a 
                    href="{{ URL::to('deletequotation', $quotation->id) }}" 
                    class="dropdown-item text-danger" 
                    onclick="return confirm('Are you sure you want to delete this quotation?')">
                    Delete
                </a>
            </li>
        </ul>
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

      <x-adminfooter/>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

      <div class="modal-dialog modal-lg">

            <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Add New Record</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <form action="{{ URL::to('/addquotations') }}" method="POST">

                @csrf

                <div class="modal-body">

                  <div class="cmvb-div bg-white p-4">

                      <div class="row gy-4">

                          <div class="col-lg-6">

                          

                          <input type="date" class="form-control" name="date"  required />

                          </div>

                        

                          <div class="col-lg-6">

                            <select class="form-control" name="customer" required>

                                <option value="" disabled selected>Choose Customer</option>

                                @foreach ($customers as $customer)

                                  <option value="{{ $customer->id }}">{{ $customer->name }}</option>

                                @endforeach

                            </select>

                          </div>

                          <div class="col-lg-6">

                            <select class="form-control" name="warehouse" required>

                                <option value="" disabled selected>Choose Warehouse</option>

                                @foreach ($warehouses as $warehouse)

                                  <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>

                                @endforeach

                            </select>

                          </div>

                      

                        

                      </div>

                  </div>



                  <div class="cmvb-div bg-white p-4">

                    <div class="row gy-4">

                    

                    

                      <div class="col-lg-6 standard-only">

                        <input type="number" class="form-control" name="tax" placeholder="Order Tax" required />

                      </div>



                  

                      <div class="col-lg-6 standard-only variable-only">

                        <input type="number" class="form-control" name="discount" placeholder="Discount" required />

                      </div>



                    

                      <div class="col-lg-6 standard-only variable-only">

                        <input type="number" class="form-control" name="shipping" placeholder="Shipping" required />

                      </div>



                      <div class="col-lg-6">

                          <label class="form-label">Please provide any details</label>

                          <textarea class="form-control desiri derty2" name="otherdetails" required></textarea>

                      </div>



                    

                    

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
<!--Update quotation-->
    <div class="modal fade" id="editQuotationModal" tabindex="-1" aria-labelledby="editQuotationLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="{{ url('/updatequotation') }}" method="POST">
        @csrf
        <input type="hidden" name="quotation_id" id="edit_quotation_id">

        <div class="modal-header">
          <h5 class="modal-title" id="editQuotationLabel">Edit Quotation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="cmvb-div bg-white p-4">
            <div class="row gy-4">
              <div class="col-lg-6">
                <input type="date" class="form-control" name="date" id="edit_date" required>
              </div>
              <div class="col-lg-6">
                <select class="form-control" name="customer" id="edit_customer" required>
                  <option value="" disabled>Choose Customer</option>
                  @foreach ($customers as $customer)
                  <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-lg-6">
                <select class="form-control" name="warehouse" id="edit_warehouse" required>
                  <option value="" disabled>Choose Warehouse</option>
                  @foreach ($warehouses as $warehouse)
                  <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="cmvb-div bg-white p-4 mt-4">
            <div class="row gy-4">
              <div class="col-lg-6">
                <input type="number" class="form-control" name="tax" id="edit_tax" placeholder="Order Tax" required>
              </div>
              <div class="col-lg-6">
                <input type="number" class="form-control" name="discount" id="edit_discount" placeholder="Discount" required>
              </div>
              <div class="col-lg-6">
                <input type="number" class="form-control" name="shipping" id="edit_shipping" placeholder="Shipping" required>
              </div>
              <div class="col-lg-6">
                <label class="form-label">Please provide any details</label>
                <textarea class="form-control" name="otherdetails" id="edit_otherdetails" required></textarea>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update Quotation</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  document.querySelectorAll('.edit-quotation-btn').forEach(button => {
    button.addEventListener('click', function () {
      document.getElementById('edit_quotation_id').value = this.dataset.id;
      document.getElementById('edit_date').value = this.dataset.date;
      document.getElementById('edit_customer').value = this.dataset.customer;
      document.getElementById('edit_warehouse').value = this.dataset.warehouse;
      document.getElementById('edit_tax').value = this.dataset.tax;
      document.getElementById('edit_discount').value = this.dataset.discount;
      document.getElementById('edit_shipping').value = this.dataset.shipping;
      document.getElementById('edit_otherdetails').value = this.dataset.otherdetails;
    });
  });
</script>
