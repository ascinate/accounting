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
                        <h6 class="mb-10">Settings</h6>
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
                            <h6>Logo</h6>
                          </th>
                          <th class="lead-info">
                            <h6>currency</h6>
                          </th>
                          <th class="lead-email">
                            <h6>Company Name</h6>
                          </th>
                          <th class="lead-phone">
                            <h6>Company Phone</h6>
                          </th>
                         
                          
                          <th>
                            <h6>Action</h6>
                          </th>
                        </tr>
                        <!-- end table row-->
                      </thead>
                      <tbody>
                      @foreach($settings as $setting)
                        <tr>
                          <td class="min-width">
                            <div class="lead">
                             
                              <div class="lead-text">
                              <img src="{{ asset('uploads/' . $setting->logo) }}" alt="Media" width="100">
                              </div>
                            </div>
                          </td>
                          <td class="min-width">
                          <p>{{ $setting->currency }}</p>
                          </td>
                         
                          <td class="min-width">
                          <p>{{ $setting->company_name }}</p>
                          </td>

                          <td class="min-width">
                          <p>{{ $setting->company_phone }}</p>
                          </td>
                         
                         
                          <td>
                            <div class="action">
                            <a href="{{ URL::to('deletesettings', $setting->id) }}" class="text-danger"  onclick="return confirm('Are you sure you want to delete this Setting?')">
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
                <h5 class="modal-title" id="exampleModalLabel">System settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ URL::to('/addsettings') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                  <div class="cmvb-div bg-white p-4">
                      <div class="row gy-4">
                          
                        
                          <div class="col-lg-6">
                            <label class="form-label">Default Currency *</label>
                            <select class="form-control" name="currency" required>
                                  <option value="Us Doller">Us Doller</option>
                         
                            </select>
                          </div>
                          
                          <div class="col-lg-6">
                          <label class="form-label">Default email</label>
                           <input type="text" class="form-control" name="email" placeholder="admin@example.com" required />
                          </div> 
                          
                          <div class="col-lg-6">
                          <label class="form-label">Change logo</label>
                           <input type="file" class="form-control" name="logo" required />
                          </div>

                          <div class="col-lg-6">
                          <label class="form-label">Company name *</label>
                           <input type="text" class="form-control" name="company_name" placeholder="Company name" required />
                          </div> 
                          
                          <div class="col-lg-6">
                          <label class="form-label">Company phone</label>
                           <input type="number" class="form-control" name="company_phone" placeholder="Pdf footer" required />
                          </div>
                          <div class="col-lg-6">
                          <label class="form-label">Pdf footer</label>
                           <input type="text" class="form-control" name="pdf_footer" placeholder="Pdf footer" required />
                          </div> 
                          
                          <div class="col-lg-6">
                          <label class="form-label">Developed by *</label>
                           <input type="text" class="form-control" name="developer" placeholder="Developed by" required />
                          </div>
                          <div class="col-lg-6">
                          <label class="form-label">App name *</label>
                           <input type="text" class="form-control" name="app_name" placeholder="App name" required />
                          </div> 
                          
                          <div class="col-lg-6">
                          <label class="form-label">Footer *</label>
                           <input type="text" class="form-control" name="footer" placeholder="Posly - POS With Ultimate Inventory" required />
                          </div>
                          <div class="col-lg-6">
                            <label class="form-label">Default Language *</label>
                            <select class="form-control" name="language" required>
                                  <option value="Hindi">Hindi</option>
                                  <option value="English">English</option>
                                  <option value="Bengali">Bengali</option>
                                  <option value="Arbic">Arbic</option>                      
                            </select>
                          </div>
                          <div class="col-lg-6">
                            <label class="form-label">Default Customer</label>
                            <select class="form-control" name="customer" required>
                             
                                @foreach ($customers as $customer)
                                  <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="col-lg-6">
                            <label class="form-label">Default Warehouse</label>
                            <select class="form-control" name="warehouse" required>                             
                                @foreach ($warehouses as $warehouse)
                                  <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="col-lg-6">
                            <label class="form-label">Company adress *</label>
                            <textarea class="form-control desiri derty2" name="company_address" required></textarea>
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
   

