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
                            <h6>Email</h6>
                          </th>
                          <th class="lead-phone">
                            <h6>Role</h6>
                          </th>
                          <th class="lead-company">
                            <h6>Warehouse</h6>
                          </th>
                          <th>
                            <h6>Action</h6>
                          </th>
                        </tr>
                        <!-- end table row-->
                      </thead>
                      <tbody>
                      @foreach($users as $user)
                        <tr>
                          <td class="min-width">
                            <div class="lead">
                             
                              <div class="lead-text">
                                <p>{{ $user->name }}</p>
                              </div>
                            </div>
                          </td>
                          <td class="min-width">
                            <p><a href="#0">{{ $user->email }}</a></p>
                          </td>
                          <td class="min-width">
                            <p>{{ $user->role }}</p>
                          </td>
                          <td class="min-width">
                            <p>{{ $user->warehouse }}</p>
                          </td>
                          <td>
                            <div class="action">
                             <a href="{{ URL::to('deleteuser', $user->id) }}" class="text-danger"  onclick="return confirm('Are you sure you want to delete this User?')">
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
      <!-- ========== table components end ========== -->
      <x-adminfooter/>
      
    </main>
    

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Record</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ URL::to('/add-record') }}" method="POST" enctype="multipart/form-data">
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
                <input type="password" class="form-control" name="password" placeholder="Password" required />
                </div>
                
                <div class="col-lg-6">
                <select class="form-control" name="role_id" required>
                    <option value="" disabled selected>Choose Role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>

                </div>
                <div class="col-lg-6">
                <select class="form-control" name="status" required>
                    <option value="" disabled selected>Choose Status</option>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
                </div>
                <div class="col-lg-6">
                <input class="form-control" type="file" name="profile_image" id="formFile" />
                </div>
                <div class="col-lg-4">
                <p>Access warehouses</p>
                <select class="form-control" name="warehouse">
                    <option value="" disabled selected>Choose Warehouse</option>
                    <option value="Warehouse 1">Warehouse 1</option>
                    <option value="Warehouse 2">Warehouse 2</option>
                    <option value="Warehouse 3">Warehouse 3</option>
                </select>
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


    