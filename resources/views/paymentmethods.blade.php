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

                            <h6>Name</h6>

                          </th>

                         

                          

                          <th>

                            <h6>Action</h6>

                          </th>

                        </tr>

                        <!-- end table row-->

                      </thead>

                      <tbody>

                      @foreach($paymentmethods as $paymentmethod)

                        <tr>

                          <td class="min-width">

                            <div class="lead">

                             

                              <div class="lead-text">

                              <p><a href="#0">{{ $paymentmethod->name }}</a></p>

                              </div>

                            </div>

                          </td>

                         

                         

                          <td>

                            <div class="action">
                            <a href="#" class="text-primary" onclick="editPaymentMethod({{ $paymentmethod->id }}, '{{ $paymentmethod->name }}')">
            <i class="lni lni-pencil-alt"></i> Edit
        </a>

                            <a href="{{ URL::to('deletepayment', $paymentmethod->id) }}" class="text-danger"  onclick="return confirm('Are you sure you want to delete this payment method?')">

                                <i class="lni lni-trash-can"></i>

                            </a>



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

            <form action="{{ URL::to('/addpayment') }}" method="POST">

                @csrf

                <div class="modal-body">

                    <div class="cmvb-div bg-white p-4">

                        <div class="row gy-4">

                            <div class="col-lg-6"> 

                            <input type="text" class="form-control" name="name" placeholder="Payment Type"  required />

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

   <!-- Edit Payment Method Modal -->
<div class="modal fade" id="editPaymentMethodModal" tabindex="-1" aria-labelledby="editPaymentMethodModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPaymentMethodModalLabel">Edit Payment Method</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ url('/updatepayment') }}" method="POST">
                @csrf
                <input type="hidden" name="paymentmethod_id" id="edit_paymentmethod_id">
                
                <div class="modal-body">
                    <div class="cmvb-div bg-white p-4">
                        <div class="row gy-4">
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="name" id="edit_paymentmethod_name" placeholder="Payment Type" required />
                            </div>
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
  // JavaScript function to open the edit modal and prefill the data
function editPaymentMethod(id, name) {
    // Set the payment method ID in the hidden input field
    document.getElementById('edit_paymentmethod_id').value = id;

    // Set the payment method name in the input field
    document.getElementById('edit_paymentmethod_name').value = name;

    // Show the modal
    $('#editPaymentMethodModal').modal('show');
}

</script>