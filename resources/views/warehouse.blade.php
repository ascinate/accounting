<x-adminheader/>



      <!-- ========== table components start ========== -->

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

                            <h6>Name</h6>

                          </th>

                          <th class="lead-email">

                            <h6>Zipcode</h6>

                          </th>



                          <th class="lead-phone">

                            <h6>Phone</h6>

                          </th>

                          

                          <th>

                            <h6>Action</h6>

                          </th>

                        </tr>

                        <!-- end table row-->

                      </thead>

                      <tbody>

                      @foreach($warehouses as $warehouse)

                        <tr>

                          <td class="min-width">

                            <div class="lead">

                             

                              <div class="lead-text">

                              <p><a href="#0">{{ $warehouse->name }}</a></p>

                              </div>

                            </div>

                          </td>

                          <td class="min-width">

                            <p><a href="#0">{{ $warehouse->zipcode }}</a></p>

                          </td>

                          <td class="min-width">

                            <p><a href="#0">{{ $warehouse->phone }}</a></p>

                          </td>

                          <td class="min-width">

                            <div class="action">
                            <a href="#editWarehouseModal" 
   class="text-primary" 
   data-bs-toggle="modal"
   onclick="editWarehouse(
       '{{ $warehouse->id }}',
       '{{ $warehouse->name }}',
       '{{ $warehouse->phone }}',
       '{{ $warehouse->country }}',
       '{{ $warehouse->city }}',
       '{{ $warehouse->email }}',
       '{{ $warehouse->zipcode }}'
   )">
    <i class="lni lni-pencil"></i>
</a>


                            <a href="{{ URL::to('deletewarehouse', $warehouse->id) }}" class="text-danger"  onclick="return confirm('Are you sure you want to delete this Warehouse?')">

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

        <form action="{{ URL::to('/addwarehouse') }}" method="POST">

            @csrf

            <div class="modal-body">

            <div class="row gy-4">

                <div class="col-lg-6">

                <input type="text" class="form-control" name="name" placeholder="Warehouse Name" required />

                </div>

                <div class="col-lg-6">

                <input type="number" class="form-control" name="phone" placeholder="Warehouse Phone No" required />

                </div>

                <div class="col-lg-6">

                <input type="text" class="form-control" name="country" placeholder="Country" required />

                </div>

                <div class="col-lg-6">

                <input type="text" class="form-control" name="city" placeholder="City" required />

                </div>

                <div class="col-lg-6">

                <input type="email" class="form-control" name="email" placeholder="email" required />

                </div>

                <div class="col-lg-6">

                <input type="number" class="form-control" name="zipcode" placeholder="Zipcode" required />

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


    <div class="modal fade" id="editWarehouseModal" tabindex="-1" aria-labelledby="editWarehouseLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Warehouse</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ url('/updatewarehouse') }}" method="POST">
        @csrf
        <input type="hidden" name="id" id="edit_id">
        <div class="modal-body">
          <div class="row gy-4">
            <div class="col-lg-6">
              <input type="text" id="edit_name" name="name" class="form-control" placeholder="Warehouse Name" required>
            </div>
            <div class="col-lg-6">
              <input type="number" id="edit_phone" name="phone" class="form-control" placeholder="Phone" required>
            </div>
            <div class="col-lg-6">
              <input type="text" id="edit_country" name="country" class="form-control" placeholder="Country" required>
            </div>
            <div class="col-lg-6">
              <input type="text" id="edit_city" name="city" class="form-control" placeholder="City" required>
            </div>
            <div class="col-lg-6">
              <input type="email" id="edit_email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="col-lg-6">
              <input type="number" id="edit_zipcode" name="zipcode" class="form-control" placeholder="Zipcode" required>
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
    function editWarehouse(id, name, phone, country, city, email, zipcode) {
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_phone').value = phone;
        document.getElementById('edit_country').value = country;
        document.getElementById('edit_city').value = city;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_zipcode').value = zipcode;
    }
</script>

