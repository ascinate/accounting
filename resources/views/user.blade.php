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
                                <i class="lni lni-users me-2"></i>User Management
                            </h5>
                        </div>
                        <div class="d-flex gap-2">
                            <!-- Create Button -->
                            <button type="button" class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="lni lni-plus me-2"></i>Create User
                            </button>
                            
                            <!-- Export Dropdown -->
                            <div class="dropdown">
                                <button class="btn btn-success px-4 dropdown-toggle" type="button" id="exportDropdown" 
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="lni lni-download me-2"></i>Export
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="exportDropdown">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center py-2" href="{{ url('/user/export/excel') }}">
                                            <i class="lni lni-file-excel me-2 text-success"></i>
                                            <span>Excel (CSV)</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center py-2" href="{{ url('/user/export/pdf') }}">
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
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Role</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Warehouse</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr class="border-bottom">
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                @if($user->profile_image)
                                                    <img src="{{ asset('uploads/'.$user->profile_image) }}" alt="Profile" 
                                                         class="rounded-circle border" width="40" height="40">
                                                @else
                                                    <div class="avatar-placeholder rounded-circle bg-light text-secondary d-flex align-items-center justify-content-center" 
                                                         style="width:40px;height:40px;">
                                                        <i class="lni lni-user fs-5"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="mb-0 fw-semibold">{{ $user->name }}</p>
                                                <small class="text-muted">ID: {{ $user->id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $user->email }}" class="text-primary text-decoration-none">
                                            {{ $user->email }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-1 rounded-pill">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info bg-opacity-10 text-info px-3 py-1 rounded-pill">
                                            {{ $user->warehouse }}
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

            <!-- Edit Option -->
            <li>
                <button class="dropdown-item d-flex align-items-center gap-2 editUserBtn"
                        data-id="{{ $user->id }}"
                        data-name="{{ $user->name }}"
                        data-email="{{ $user->email }}"
                        data-role="{{ $user->role_id }}" 
                        data-status="{{ $user->status }}"
                        data-warehouse="{{ $user->warehouse }}"
                        data-image="{{ asset('uploads/'.$user->profile_image) }}"
                        data-bs-toggle="modal" 
                        data-bs-target="#editUserModal">
                    <i class="lni lni-pencil text-primary"></i>
                    <span>Edit User</span>
                </button>
            </li>

            <!-- Delete Option -->
            <li>
                <a class="dropdown-item d-flex align-items-center gap-2 text-danger"
                   href="{{ URL::to('deleteuser', $user->id) }}" 
                   onclick="return confirm('Are you sure you want to delete this user?')">
                    <i class="lni lni-trash-can"></i>
                    <span>Delete User</span>
                </a>
            </li>

        </ul>
    </div>
</td>
s
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

  <!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="{{ url('/update-user') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" id="edit-user-id" />

        <div class="modal-body">
          <div class="row gy-4">
            <!-- Name -->
            <div class="col-lg-6">
              <input type="text" class="form-control" name="name" id="edit-user-name" placeholder="Name" required />
            </div>

            <!-- Email -->
            <div class="col-lg-6">
              <input type="email" class="form-control" name="email" id="edit-user-email" placeholder="Email" required />
            </div>

            <!-- Password -->
            <div class="col-lg-6">
              <input type="password" class="form-control" name="password" placeholder="New Password (optional)" />
            </div>

            <!-- Role -->
            <div class="col-lg-6">
              <select class="form-control" name="role_id" id="edit-user-role" required>
                <option value="" disabled selected>Choose Role</option>
                @foreach($roles as $role)
                  <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
              </select>
            </div>

            <!-- Status -->
            <div class="col-lg-6">
              <select class="form-control" name="status" id="edit-user-status" required>
                <option value="" disabled selected>Choose Status</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
              </select>
            </div>

            <!-- Profile Image -->
            <div class="col-lg-6">
              <input class="form-control" type="file" name="profile_image" id="edit-user-image" />
              <img id="edit-user-image-preview" src="" alt="Profile Image" width="60" height="60" class="mt-2" />
            </div>

            <!-- Warehouse -->
            <div class="col-lg-6">
              <select class="form-control" name="warehouse" id="edit-user-warehouse">
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
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.editUserBtn').forEach(button => {
        button.addEventListener('click', function () {
            // Retrieve user data from data-* attributes
            const userId = this.getAttribute('data-id');
            const userName = this.getAttribute('data-name');
            const userEmail = this.getAttribute('data-email');
            const userRole = this.getAttribute('data-role');
            const userStatus = this.getAttribute('data-status');
            const userWarehouse = this.getAttribute('data-warehouse');
            const userImage = this.getAttribute('data-image');

            // Populate modal fields
            document.getElementById('edit-user-id').value = userId;
            document.getElementById('edit-user-name').value = userName;
            document.getElementById('edit-user-email').value = userEmail;
            
            // Set the role select value
            const roleSelect = document.getElementById('edit-user-role');
            if (roleSelect) {
                roleSelect.value = userRole;
            }
            
            // Set the status select value
            const statusSelect = document.getElementById('edit-user-status');
            if (statusSelect) {
                statusSelect.value = userStatus;
            }
            
            // Set the warehouse select value
            const warehouseSelect = document.getElementById('edit-user-warehouse');
            if (warehouseSelect) {
                warehouseSelect.value = userWarehouse;
            }

            // Handle profile image preview
            const imagePreview = document.getElementById('edit-user-image-preview');
            if (userImage) {
                imagePreview.src = userImage;
                imagePreview.style.display = 'block';
            } else {
                imagePreview.style.display = 'none';
            }

            // Show the modal
            const editModal = new bootstrap.Modal(document.getElementById('editUserModal'));
            editModal.show();
        });
    });
});

</script>
