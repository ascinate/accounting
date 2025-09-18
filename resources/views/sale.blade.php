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

                            <h6>Customer</h6>

                          </th>

                          <th class="lead-email">

                            <h6>Warehouse</h6>

                          </th>

                          <th class="lead-phone">

                            <h6>Tax</h6>

                          </th>

                          <th class="lead-phone">

                            <h6>Grand Total</h6>

                          </th>



                          <th class="lead-sale">

                            <h6>Paid</h6>

                          </th>

                          <th class="lead-due">

                            <h6>Due</h6>

                          </th>



                          <th class="lead-status">

                            <h6>Status</h6>

                          </th>

                          

                          

                          <th>

                            <h6>Action</h6>

                          </th>

                        </tr>

                        <!-- end table row-->

                      </thead>

                      <tbody>

                      @foreach($sales as $sale)

                        <tr>

                          <td class="min-width">

                            <div class="lead">

                             

                              <div class="lead-text">

                              <p><a href="#0">{{ $sale->date }}</a></p>

                              </div>

                            </div>

                          </td>

                          <td class="min-width">

                          <p>{{ $sale->customer_name ?? 'No Customer' }}</p>

                          </td>

                         

                          <td class="min-width">

                          <p>{{ $sale->warehouse_name ?? 'No Warehouse' }}</p>

                          </td>



                          <td class="min-width">

                            <p>{{ $sale->tax }}</p>

                          </td>

                          <td class="min-width">

                              <p>

                              {{ number_format($sale->amount, 2) }}

                            </p>

                          </td>

                          <td class="min-width">

                              <p>

                              {{ number_format($sale->paid_amount, 2) }}

                            </p>

                          </td>

                          <td class="min-width">

                              <p>

                              {{ number_format($sale->due_amount, 2) }}

                            </p>

                          </td>



                          <td class="min-width">

                              <p>

                              {{ $sale->status }}

                            </p>

                          </td>

                         

                          <td>

                            <div class="dropdown">

                                <button class="btn btn-sm btn-secondary dropdown-toggle" style="border: 1px solid #000; background-color: transparent; color: #000;" type="button" id="actionDropdown{{ $sale->id }}" data-bs-toggle="dropdown" aria-expanded="false">

                                   <p> Action <i class="lni lni-chevron-down ms-1"></i></p>

                                </button>

                                <ul class="dropdown-menu" aria-labelledby="actionDropdown{{ $sale->id }}">

                                    <li>

                                        <button type="button" class="dropdown-item pay-btn"

                                            data-saleid="{{ $sale->id }}"

                                            data-total="{{ $sale->due_amount }}">

                                            Create Payment

                                        </button>

                                    </li>
                                    <li>
                                      <li>
                                          <a class="dropdown-item" href="{{ route('sale.edit', $sale->id) }}">
                                              <i class="lni lni-pencil"></i> Edit Sale
                                          </a>
                                      </li>
                          

                                    <li>

                                        <a class="dropdown-item text-danger" href="{{ URL::to('deletesales', $sale->id) }}" onclick="return confirm('Are you sure you want to delete this sale?')">

                                            <i class="lni lni-trash-can"></i> Delete Sale

                                        </a>

                                    </li>

                                    <li>

                                    <a class="dropdown-item" href="{{ url('/download-pdf/' . $sale->id) }}">

                                        <i class="lni lni-download me-1"></i> Download PDF

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



    <!-- Payment Modal -->

    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">

      <div class="modal-dialog">

        <form id="paymentForm" action="{{ URL::to('/createpayment') }}"  method="POST">

            @csrf

            <input type="hidden" name="saleid" id="modal_saleid">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">Make Payment</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                </div>

                <div class="modal-body">

                    <p>Total Amount: $<span id="modal_total"></span></p>

                    <input type="hidden" id="modal_total_input" name="total">

                    <div class="form-group mt-2">

                        <label>Pay Amount</label>

                        <input type="number" class="form-control" name="pay_amount" id="pay_amount"  step="0.01" required />

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-success">Submit Payment</button>

                </div>

            </div>

        </form>

      </div>

    </div>



    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Add New Record</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <form  action="{{ URL::to('/addsales') }}" method="POST">

                @csrf

                <div class="modal-body">

                    <div class="cmvb-div bg-white p-4">

                        <div class="row gy-4">

                            <div class="col-lg-6">

                            

                            <input type="date" class="form-control" name="date"  required />

                            </div>

                        

                            <div class="col-lg-6">

                            <select class="form-control" name="category" required>

                                <option value="" disabled selected>Choose Customer</option>

                                @foreach ($customers as $customer)

                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>

                                @endforeach

                            </select>

                            </div>

                            <div class="col-lg-6">

                            <select class="form-control" name="brand" required>

                                <option value="" disabled selected>Choose Warehouse</option>

                                @foreach ($warehouses as $warehouse)

                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>

                                @endforeach

                            </select>

                            </div>

                        

                        

                        </div>

                    </div>

                        

                    



                    <div class="card mt-5">

                      <div class="card-body">

                        <div class="row">

                          <div class="col-md-12 mb-5 mt-3">

                            <div id="autocomplete" class="autocomplete">

                               <input type="text" id="productSearch" class="form-control" placeholder="Scan/Search Product by code or name">

                               <ul id="productDropdown" class="dropdown-menu w-100"></ul>

                              </div>

                            </div> 

                            <div class="col-md-12">

                              <div class="table-responsive">

                                <table class="table table-hover table-md">

                                  <thead>

                                    <tr>

                                    <th>#</th>

                                        <th>Code</th>

                                        <th>Product Name</th>

                                        <th>Current Stock</th>

                                        <th>Qty</th>

                                        <th>Type</th>

                                        <th>Total Price</th>

                                    </tr>

                                  </thead> 

                                  <tbody id="productTable">

                                    <tr>

                                      <td colspan="7">No data Available</td>

                                    </tr>

                                  </tbody>

                                </table>

                              </div>

                             </div> 

                             <input type="hidden" name="product_id" id="product_id">

                             <input type="hidden" name="final_quantity" id="final_quantity">

                             <input type="hidden" name="final_price" id="final_price">

                             <input type="hidden" name="final_totalprice" id="final_totalprice">





                             <div class="offset-md-9 col-md-3 mt-4">

                              <table class="table table-striped table-sm">

                                <tbody>

                              

                                  <tr>

                                    <td class="bold">Discount</td> 

                                    <td><span class="discount-amount">$ 0.00</span></td>

                                  </tr> 

                                 

                                  <tr>

                                    <td>

                                      <span class="font-weight-bold">Grand Total</span>

                                    </td> 

                                    <td>

                                      <span class="font-weight-bold grand-total">$ 0.00</span>

                                    </td>

                                  </tr>

                                </tbody>

                              </table>

                           </div>

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





    <x-adminfooter/>

