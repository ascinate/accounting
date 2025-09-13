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
                            <h6>Date</h6>
                          </th>
                          <th class="lead-info">
                            <h6>Account</h6>
                          </th>
                          <th class="lead-email">
                            <h6>Category</h6>
                          </th>
                          <th class="lead-phone">
                            <h6>Amount</h6>
                          </th>
                          <th class="lead-phone">
                            <h6>Payment Method</h6>
                          </th>
                          
                          <th>
                            <h6>Action</h6>
                          </th>
                        </tr>
                        <!-- end table row-->
                      </thead>
                      <tbody>
                      @foreach($deposits as $deposit)
                        <tr>
                          <td class="min-width">
                            <div class="lead">
                             
                              <div class="lead-text">
                              <p><a href="#0">{{ $deposit->date }}</a></p>
                              </div>
                            </div>
                          </td>
                          <td class="min-width">
                          <p>{{ $deposit->account_name ?? 'No account' }}</p>
                          </td>
                         
                          <td class="min-width">
                          <p>{{ $deposit->category_name ?? 'No category' }}</p>
                          </td>

                          <td class="min-width">
                            <p>{{ $deposit->amount }}</p>
                          </td>
                          <td class="min-width">
                            <p>{{ $deposit->payment_method }}</p>
                          </td>
                         
                          <td>
                            <div class="action">
                            <a href="{{ URL::to('deletedeposits', $deposit->id) }}" class="text-danger"  onclick="return confirm('Are you sure you want to delete this deposit?')">
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
            <form action="{{ URL::to('/adddeposit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="cmvb-div bg-white p-4">
                        <div class="row gy-4">
                            <div class="col-lg-6">
                                <select class="form-control" name="account" required>
                                    <option value="" disabled selected>Choose Account</option>
                                    @foreach ($accounts as $account)
                                        <option value="{{ $account->id }}">{{ $account->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <select class="form-control" name="category" required>
                                    <option value="" disabled selected>Choose Category</option>
                                    @foreach ($category as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-6">
                            
                            <input type="number" class="form-control" name="deposit_ref" placeholder="Deposit Ref"   required />
                            </div>
                            <div class="col-lg-6">
                            
                            <input type="date" class="form-control" name="date" placeholder="Deposit Date"  required />
                            </div>
                            <div class="col-lg-6">
                            
                            <input type="number" class="form-control" name="amount" placeholder="Deposit Amount"  required />
                            </div>
                            <div class="col-lg-6">
                                <select class="form-control" name="paymentmethod" required>
                                    <option value="" disabled selected>Payment Method</option>
                                    <option value="Check">Check</option>
                                    <option value="Credit Card">Credit Card</option>
                                    <option value="Paypal">Paypal</option>
                                    <option value="Bank Transfer">Bank Transfer</option>
                                </select>
                           </div>
                           <div class="col-lg-6">
                            
                            <input type="file" class="form-control" name="attachment" required />
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Other Details</label>
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
   
   

