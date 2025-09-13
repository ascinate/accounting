<x-adminheader/>
      <!-- ========== header end ========== -->

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
        <div class="card mb-4 border-0 shadow">
    <div class="card-header bg-white py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0 fw-bold text-primary">
                    <i class="lni lni-cog me-2"></i>Permissions
                </h5>
            </div>

            <div class="d-flex gap-2">
                <!-- Create Button -->
                <button type="button" class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="lni lni-plus me-2"></i>Create
                </button>

                <!-- Export Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-success px-4 dropdown-toggle" type="button" id="exportDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="lni lni-download me-2"></i>Export
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="exportDropdown">
                        <li>
                            <a class="dropdown-item d-flex align-items-center py-2" href="{{ url('/role/export/excel') }}">
                                <i class="lni lni-file-excel me-2 text-success"></i>
                                <span>Excel (CSV)</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center py-2" href="{{ url('/role/export/pdf') }}">
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
                        <th class="ps-4 text-uppercase text-secondary text-xs font-weight-bolder">Role Name</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder">Description</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder text-end pe-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr class="border-bottom">
                            <td class="ps-4">
                                <p class="mb-0 fw-semibold">{{ $role->name }}</p>
                            </td>
                            <td>
                                <span class="text-muted">{{ $role->description }}</span>
                            </td>
                            <td class="text-end pe-4">
                                <p class="mb-0 fw-semibold">Cannot change default permissions</p>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

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
            <h5 class="modal-title" id="exampleModalLabel">Add New Role</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ URL::to('/add-role') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row gy-4">
                    <div class="col-lg-6">
                    <input type="text" class="form-control" name="name" placeholder="Role Name" required />
                    </div>
                    <div class="col-lg-6">
                    <input type="text" class="form-control" name="description" placeholder="Description" required />
                    </div>
                </div>
                <div class="row gy-4">
                  <table class="table table-bordered table_permissions">
                    <tbody>

                      <tr>
                        <th>Dashboard</th>
                        <td>
                          <div class="pt-3">

                            <div class="form-check form-check-inline w-100">
                              <label class="checkbox checkbox-primary" for="dashboard">
                                <input type="checkbox" name="permissions[]" id="dashboard" value="dashboard"><span>Dashboard</span><span class="checkmark"></span>
                              </label>
                            </div>

                          </div>
                        </td>
                      </tr>

                      <tr>
                        <th>Users</th>
                        <td>
                          <div class="pt-3">
                            <div class="form-check form-check-inline w-100">
                              <label class="checkbox checkbox-primary" for="user_view">
                                <input type="checkbox" name="permissions[]" id="user_view" value="user_view"><span>View user</span><span class="checkmark"></span>
                              </label>
                            </div>

                            <div class="form-check form-check-inline w-100">
                              <label class="checkbox checkbox-primary" for="user_add">
                                <input type="checkbox" name="permissions[]" id="user_add" value="user_add"><span>Add user</span><span class="checkmark"></span>
                              </label>
                            </div>

                            <div class="form-check form-check-inline w-100">
                              <label class="checkbox checkbox-primary" for="user_edit">
                                <input type="checkbox" name="permissions[]" id="user_edit" value="user_edit"><span>Edit user</span><span class="checkmark"></span>
                              </label>
                            </div>

                            <div class="form-check form-check-inline w-100">
                              <label class="checkbox checkbox-primary" for="user_delete">
                                <input type="checkbox" name="permissions[]" id="user_delete" value="user_delete"><span>Delete user</span><span class="checkmark"></span>
                              </label>
                            </div>

                          </div>
                        </td>
                      </tr>

                      <tr>
                          <th>Roles</th>
                          <td>
                            <div class="pt-3">
                              <div class="form-check form-check-inline w-100">
                                <label class="checkbox checkbox-primary" for="role_view">
                                  <input type="checkbox" name="permissions[]" id="role_view" value="role_view"><span>Roles</span><span class="checkmark"></span>
                                </label>
                              </div>
    
                            </div>
                          </td>
                        </tr>

                      <tr>
                        <th>Products</th>
                        <td>
                          <div class="pt-3">


                            <div class="form-check form-check-inline w-100">
                              <label class="checkbox checkbox-primary" for="products_view">
                                <input type="checkbox" name="permissions[]" id="products_view" value="products_view"><span>View Product</span><span class="checkmark"></span>
                              </label>
                            </div>

                            <div class="form-check form-check-inline w-100">
                              <label class="checkbox checkbox-primary" for="products_add">
                                <input type="checkbox" name="permissions[]" id="products_add" value="products_add"><span>Add Product</span><span class="checkmark"></span>
                              </label>
                            </div>

                            <div class="form-check form-check-inline w-100">
                              <label class="checkbox checkbox-primary" for="products_edit">
                                <input type="checkbox" name="permissions[]" id="products_edit" value="products_edit"><span>Edit Product</span><span class="checkmark"></span>
                              </label>
                            </div>

                            <div class="form-check form-check-inline w-100">
                              <label class="checkbox checkbox-primary" for="products_delete">
                                <input type="checkbox" name="permissions[]" id="products_delete" value="products_delete"><span>Delete Product</span><span class="checkmark"></span>
                              </label>
                            </div>

                            <div class="form-check form-check-inline w-100">
                              <label class="checkbox checkbox-primary" for="print_labels">
                                <input type="checkbox" name="permissions[]" id="print_labels" value="print_labels"><span>Print Labels</span><span class="checkmark"></span>
                              </label>
                            </div>

                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th>Category</th>
                        <td>
                          <div class="pt-3">


                            <div class="form-check form-check-inline w-100">
                              <label class="checkbox checkbox-primary" for="category_view">
                                <input type="checkbox" name="permissions[]" id="category_view" value="category_view"><span>Category</span><span class="checkmark"></span>
                              </label>
                            </div>

                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th>Warehouse</th>
                        <td>
                          <div class="pt-3">


                            <div class="form-check form-check-inline w-100">
                              <label class="checkbox checkbox-primary" for="warehouse_view">
                                <input type="checkbox" name="permissions[]" id="warehouse_view" value="warehouse_view"><span>Warehouse</span><span class="checkmark"></span>
                              </label>
                            </div>

                          </div>
                        </td>
                      </tr>

                     <tr>
                      <th>Adjustments</th>
                      <td>
                        <div class="pt-3">
                          <div class="form-check form-check-inline w-100">
                            <label class="checkbox checkbox-primary" for="all_adjustment">
                              <input type="checkbox" name="permissions[]" id="all_adjustment" value="all_adjustment"><span>View all Adjustments</span><span class="checkmark"></span>
                            </label>
                          </div>

                          <div class="form-check form-check-inline w-100">
                            <label class="checkbox checkbox-primary" for="adjustment_add">
                              <input type="checkbox" name="permissions[]" id="adjustment_add" value="adjustment_add"><span>Add Adjustment</span><span class="checkmark"></span>
                            </label>
                          </div>

                          <div class="form-check form-check-inline w-100">
                            <label class="checkbox checkbox-primary" for="adjustment_edit">
                              <input type="checkbox" name="permissions[]" id="adjustment_edit" value="adjustment_edit"><span>Edit Adjustment</span><span class="checkmark"></span>
                            </label>
                          </div>
                          <div class="form-check form-check-inline w-100">
                            <label class="checkbox checkbox-primary" for="adjustment_delete">
                              <input type="checkbox" name="permissions[]" id="adjustment_delete" value="adjustment_delete"><span>Delete Adjustment</span><span class="checkmark"></span>
                            </label>
                          </div>
                          <div class="form-check form-check-inline w-100">
                            <label class="checkbox checkbox-primary" for="adjustment_details">
                              <input type="checkbox" name="permissions[]" id="adjustment_details" value="adjustment_details"><span>Adjustment details</span><span class="checkmark"></span>
                            </label>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th>Purchases</th>
                      <td>
                        <div class="pt-3">
                          <div class="form-check form-check-inline w-100">
                            <label class="checkbox checkbox-primary" for="all_purchases">
                              <input type="checkbox" name="permissions[]" id="all_purchases" value="all_purchases"><span>View all Purchases</span><span class="checkmark"></span>
                            </label>
                          </div>

                          <div class="form-check form-check-inline w-100">
                            <label class="checkbox checkbox-primary" for="purchases_add">
                              <input type="checkbox" name="permissions[]" id="purchases_add" value="purchases_add"><span>Add Purchases</span><span class="checkmark"></span>
                            </label>
                          </div>

                          <div class="form-check form-check-inline w-100">
                            <label class="checkbox checkbox-primary" for="purchases_edit">
                              <input type="checkbox" name="permissions[]" id="purchases_edit" value="purchases_edit"><span>Edit Purchases</span><span class="checkmark"></span>
                            </label>
                          </div>
                          <div class="form-check form-check-inline w-100">
                            <label class="checkbox checkbox-primary" for="purchases_delete">
                              <input type="checkbox" name="permissions[]" id="purchases_delete" value="purchases_delete"><span>Delete Purchases</span><span class="checkmark"></span>
                            </label>
                          </div>
                          <div class="form-check form-check-inline w-100">
                            <label class="checkbox checkbox-primary" for="purchases_details">
                              <input type="checkbox" name="permissions[]" id="purchases_details" value="purchases_details"><span>Purchases details</span><span class="checkmark"></span>
                            </label>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th>Sales</th>
                      <td>
                        <div class="pt-3">
                          <div class="form-check form-check-inline w-100">
                            <label class="checkbox checkbox-primary" for="all_sales">
                              <input type="checkbox" name="permissions[]" id="all_sales" value="all_sales"><span>View all Sales</span><span class="checkmark"></span>
                            </label>
                          </div>

                          <div class="form-check form-check-inline w-100">
                            <label class="checkbox checkbox-primary" for="sales_add">
                              <input type="checkbox" name="permissions[]" id="sales_add" value="sales_add"><span>Add Sales</span><span class="checkmark"></span>
                            </label>
                          </div>

                          <div class="form-check form-check-inline w-100">
                            <label class="checkbox checkbox-primary" for="sales_edit">
                              <input type="checkbox" name="permissions[]" id="sales_edit" value="sales_edit"><span>Edit Sales</span><span class="checkmark"></span>
                            </label>
                          </div>
                          <div class="form-check form-check-inline w-100">
                            <label class="checkbox checkbox-primary" for="sales_delete">
                              <input type="checkbox" name="permissions[]" id="sales_delete" value="sales_delete"><span>Delete Sales</span><span class="checkmark"></span>
                            </label>
                          </div>
                          <div class="form-check form-check-inline w-100">
                            <label class="checkbox checkbox-primary" for="sales_details">
                              <input type="checkbox" name="permissions[]" id="sales_details" value="sales_details"><span>Sales details</span><span class="checkmark"></span>
                            </label>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th>Accounting</th>
                      <td>
                        <div class="pt-3">
                          <div class="form-check form-check-inline w-100">
                            <label class="checkbox checkbox-primary" for="account">
                              <input type="checkbox" name="permissions[]" id="account" value="account"><span>Account</span><span class="checkmark"></span>
                            </label>
                          </div>

                          <div class="form-check form-check-inline w-100">
                            <label class="checkbox checkbox-primary" for="deposit">
                              <input type="checkbox" name="permissions[]" id="deposit" value="deposit"><span>Deposit</span><span class="checkmark"></span>
                            </label>
                          </div>

                          <div class="form-check form-check-inline w-100">
                            <label class="checkbox checkbox-primary" for="expense">
                              <input type="checkbox" name="permissions[]" id="expense" value="expense"><span>Expense</span><span class="checkmark"></span>
                            </label>
                          </div>
                          <div class="form-check form-check-inline w-100">
                            <label class="checkbox checkbox-primary" for="payment_method">
                              <input type="checkbox" name="permissions[]" id="payment_method" value="payment_method"><span>Payment Method</span><span class="checkmark"></span>
                            </label>
                          </div>

                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th>Transfer</th>
                      <td>
                        <div class="pt-3">
                          <div class="form-check form-check-inline w-100">
                            <label class="checkbox checkbox-primary" for="transfer">
                              <input type="checkbox" name="permissions[]" id="transfer" value="transfer"><span>Transfer</span><span class="checkmark"></span>
                            </label>
                          </div>
                        </div>
                      </td>
                    </tr>
                    
                    <tr>
                      <th>Quotations</th>
                      <td>
                        <div class="pt-3">
                          <div class="form-check form-check-inline w-100">
                            <label class="checkbox checkbox-primary" for="quotations">
                              <input type="checkbox" name="permissions[]" id="quotations" value="quotations"><span>Quotations</span><span class="checkmark"></span>
                            </label>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th>Settings</th>
                      <td>
                        <div class="pt-3">
                          <div class="form-check form-check-inline w-100">
                            <label class="checkbox checkbox-primary" for="company_settings">
                              <input type="checkbox" name="permissions[]" id="company_settings" value="company_settings"><span>Company Settings</span><span class="checkmark"></span>
                            </label>
                          </div>
                          <div class="form-check form-check-inline w-100">
                            <label class="checkbox checkbox-primary" for="currency">
                              <input type="checkbox" name="permissions[]" id="currency" value="currency"><span>Currency</span><span class="checkmark"></span>
                            </label>
                          </div>
                        </div>
                      </td>
                    </tr>


                    </tbody>
                  </table>
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


    
