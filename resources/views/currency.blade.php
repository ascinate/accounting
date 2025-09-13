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

                        <h6 class="mb-10">Currency list</h6>

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

                          <th class="lead-info">

                            <h6>Number</h6>

                          </th>

                          <th class="lead-email">

                            <h6>Amount</h6>

                          </th>

                          

                          

                          <th>

                            <h6>Action</h6>

                          </th>

                        </tr>

                        <!-- end table row-->

                      </thead>

                      <tbody>

                      @foreach($currency as $currency)

                        <tr>

                          <td class="min-width">

                            <div class="lead">

                             

                              <div class="lead-text">

                              <p><a href="#0">{{ $currency->name }}</a></p>

                              </div>

                            </div>

                          </td>

                          <td class="min-width">

                          <p>{{ $currency->code }}</p>

                          </td>

                         

                         



                          <td class="min-width">

                            <p>{{ $currency->symbol }}</p>

                          </td>

                         

                          <td>

                            <div class="action">
                              <a href="#" class="text-primary editCurrencyBtn" 
                                      data-id="{{ $currency->id }}" 
                                      data-name="{{ $currency->name }}" 
                                      data-code="{{ $currency->code }}" 
                                      data-symbol="{{ $currency->symbol }}" 
                                      data-bs-toggle="modal" 
                                      data-bs-target="#editCurrencyModal">
                                        <i class="lni lni-pencil"></i>
                                     </a>


                            <a href="{{ URL::to('deletecurrency', $currency->id) }}" class="text-danger"  onclick="return confirm('Are you sure you want to delete this currency?')">

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

            <form action="{{ URL::to('/addcurrency') }}" method="POST">

                @csrf

                <div class="modal-body">

                    <div class="cmvb-div bg-white p-4">

                        <div class="row gy-4">

                            <div class="col-lg-6">

                            <label class="form-label">Currency name *</label>

                            <input type="text" class="form-control" name="name" placeholder="Enter currency name"  required />

                            </div>



                            <div class="col-lg-6">

                            <label class="form-label">Currency code *</label>

                            <input type="number" class="form-control" name="code" placeholder="Enter currency code"   required />

                            </div>

                            <div class="col-lg-6">

                            <label class="form-label">Currency symbol *</label>

                            <input type="text" class="form-control" name="symbol" placeholder="Enter currency symbol"  required />

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

   <div class="modal fade" id="editCurrencyModal" tabindex="-1" aria-labelledby="editCurrencyModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCurrencyModalLabel">Edit Currency</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editCurrencyForm" action="{{ URL::to('/updatecurrency') }}" method="POST">
        @csrf
        <input type="hidden" name="id" id="editCurrencyId">
        <div class="modal-body">
          <div class="row gy-4">
            <div class="col-lg-6">
              <label class="form-label">Currency name *</label>
              <input type="text" class="form-control" name="name" id="editCurrencyName" required>
            </div>
            <div class="col-lg-6">
              <label class="form-label">Currency code *</label>
              <input type="number" class="form-control" name="code" id="editCurrencyCode" required>
            </div>
            <div class="col-lg-6">
              <label class="form-label">Currency symbol *</label>
              <input type="text" class="form-control" name="symbol" id="editCurrencySymbol" required>
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
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.editCurrencyBtn').forEach(function (button) {
        button.addEventListener('click', function () {
            document.getElementById('editCurrencyId').value = this.dataset.id;
            document.getElementById('editCurrencyName').value = this.dataset.name;
            document.getElementById('editCurrencyCode').value = this.dataset.code;
            document.getElementById('editCurrencySymbol').value = this.dataset.symbol;
        });
    });
});
</script>
