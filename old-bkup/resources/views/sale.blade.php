<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />
    <title>Tables | PlainAdmin Demo</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/lineicons.css" />
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="assets/css/main.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css" />

    <style>
      .btn-ams{

      }
    </style>
  </head>
  <body>
   
    <x-sidebar/>
    <div class="overlay"></div>
    <main class="main-wrapper">
      <!-- ========== header start ========== -->
      <header class="header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-5 col-md-5 col-6">
              <div class="header-left d-flex align-items-center">
                <div class="menu-toggle-btn mr-15">
                  <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                    <i class="lni lni-chevron-left me-2"></i> Menu
                  </button>
                </div>
                <div class="header-search d-none d-md-flex">
                  <form action="#">
                    <input type="text" placeholder="Search..." />
                    <button><i class="lni lni-search-alt"></i></button>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-lg-7 col-md-7 col-6">
              <div class="header-right">
                <!-- notification start -->
                <div class="notification-box ml-15 d-none d-md-flex">
                  <button class="dropdown-toggle" type="button" id="notification" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M11 20.1667C9.88317 20.1667 8.88718 19.63 8.23901 18.7917H13.761C13.113 19.63 12.1169 20.1667 11 20.1667Z"
                        fill="" />
                      <path
                        d="M10.1157 2.74999C10.1157 2.24374 10.5117 1.83333 11 1.83333C11.4883 1.83333 11.8842 2.24374 11.8842 2.74999V2.82604C14.3932 3.26245 16.3051 5.52474 16.3051 8.24999V14.287C16.3051 14.5301 16.3982 14.7633 16.564 14.9352L18.2029 16.6342C18.4814 16.9229 18.2842 17.4167 17.8903 17.4167H4.10961C3.71574 17.4167 3.5185 16.9229 3.797 16.6342L5.43589 14.9352C5.6017 14.7633 5.69485 14.5301 5.69485 14.287V8.24999C5.69485 5.52474 7.60672 3.26245 10.1157 2.82604V2.74999Z"
                        fill="" />
                    </svg>
                    <span></span>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notification">
                    <li>
                      <a href="#0">
                        <div class="image">
                          <img src="assets/images/lead/lead-6.png" alt="" />
                        </div>
                        <div class="content">
                          <h6>
                            John Doe
                            <span class="text-regular">
                              comment on a product.
                            </span>
                          </h6>
                          <p>
                            Lorem ipsum dolor sit amet, consect etur adipiscing
                            elit Vivamus tortor.
                          </p>
                          <span>10 mins ago</span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="#0">
                        <div class="image">
                          <img src="assets/images/lead/lead-1.png" alt="" />
                        </div>
                        <div class="content">
                          <h6>
                            Jonathon
                            <span class="text-regular">
                              like on a product.
                            </span>
                          </h6>
                          <p>
                            Lorem ipsum dolor sit amet, consect etur adipiscing
                            elit Vivamus tortor.
                          </p>
                          <span>10 mins ago</span>
                        </div>
                      </a>
                    </li>
                  </ul>
                </div>
                <!-- notification end -->
                <!-- message start -->
                <div class="header-message-box ml-15 d-none d-md-flex">
                  <button class="dropdown-toggle" type="button" id="message" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M7.74866 5.97421C7.91444 5.96367 8.08162 5.95833 8.25005 5.95833C12.5532 5.95833 16.0417 9.4468 16.0417 13.75C16.0417 13.9184 16.0364 14.0856 16.0259 14.2514C16.3246 14.138 16.6127 14.003 16.8883 13.8482L19.2306 14.629C19.7858 14.8141 20.3141 14.2858 20.129 13.7306L19.3482 11.3882C19.8694 10.4604 20.1667 9.38996 20.1667 8.25C20.1667 4.70617 17.2939 1.83333 13.75 1.83333C11.0077 1.83333 8.66702 3.55376 7.74866 5.97421Z"
                        fill="" />
                      <path
                        d="M14.6667 13.75C14.6667 17.2938 11.7939 20.1667 8.25004 20.1667C7.11011 20.1667 6.03962 19.8694 5.11182 19.3482L2.76946 20.129C2.21421 20.3141 1.68597 19.7858 1.87105 19.2306L2.65184 16.8882C2.13062 15.9604 1.83338 14.89 1.83338 13.75C1.83338 10.2062 4.70622 7.33333 8.25004 7.33333C11.7939 7.33333 14.6667 10.2062 14.6667 13.75ZM5.95838 13.75C5.95838 13.2437 5.54797 12.8333 5.04171 12.8333C4.53545 12.8333 4.12504 13.2437 4.12504 13.75C4.12504 14.2563 4.53545 14.6667 5.04171 14.6667C5.54797 14.6667 5.95838 14.2563 5.95838 13.75ZM9.16671 13.75C9.16671 13.2437 8.7563 12.8333 8.25004 12.8333C7.74379 12.8333 7.33338 13.2437 7.33338 13.75C7.33338 14.2563 7.74379 14.6667 8.25004 14.6667C8.7563 14.6667 9.16671 14.2563 9.16671 13.75ZM11.4584 14.6667C11.9647 14.6667 12.375 14.2563 12.375 13.75C12.375 13.2437 11.9647 12.8333 11.4584 12.8333C10.9521 12.8333 10.5417 13.2437 10.5417 13.75C10.5417 14.2563 10.9521 14.6667 11.4584 14.6667Z"
                        fill="" />
                    </svg>
                    <span></span>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="message">
                    <li>
                      <a href="#0">
                        <div class="image">
                          <img src="assets/images/lead/lead-5.png" alt="" />
                        </div>
                        <div class="content">
                          <h6>Jacob Jones</h6>
                          <p>Hey!I can across your profile and ...</p>
                          <span>10 mins ago</span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="#0">
                        <div class="image">
                          <img src="assets/images/lead/lead-3.png" alt="" />
                        </div>
                        <div class="content">
                          <h6>John Doe</h6>
                          <p>Would you mind please checking out</p>
                          <span>12 mins ago</span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="#0">
                        <div class="image">
                          <img src="assets/images/lead/lead-2.png" alt="" />
                        </div>
                        <div class="content">
                          <h6>Anee Lee</h6>
                          <p>Hey! are you available for freelance?</p>
                          <span>1h ago</span>
                        </div>
                      </a>
                    </li>
                  </ul>
                </div>
                <!-- message end -->
                <!-- profile start -->
                <div class="profile-box ml-15">
                  <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="profile-info">
                      <div class="info">
                        <div class="image">
                          <img src="assets/images/profile/profile-image.png" alt="" />
                        </div>
                        <div>
                          <h6 class="fw-500">Adam Joe</h6>
                          <p>Admin</p>
                        </div>
                      </div>
                    </div>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                    <li>
                      <div class="author-info flex items-center !p-1">
                        <div class="image">
                          <img src="assets/images/profile/profile-image.png" alt="image">
                        </div>
                        <div class="content">
                          <h4 class="text-sm">Adam Joe</h4>
                          <a class="text-black/40 dark:text-white/40 hover:text-black dark:hover:text-white text-xs"
                            href="#">Email@gmail.com</a>
                        </div>
                      </div>
                    </li>
                    <li class="divider"></li>
                    <li>
                      <a href="#0">
                        <i class="lni lni-user"></i> View Profile
                      </a>
                    </li>
                    <li>
                      <a href="#0">
                        <i class="lni lni-alarm"></i> Notifications
                      </a>
                    </li>
                    <li>
                      <a href="#0"> <i class="lni lni-inbox"></i> Messages </a>
                    </li>
                    <li>
                      <a href="#0"> <i class="lni lni-cog"></i> Settings </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                      <a href="#0"> <i class="lni lni-exit"></i> Sign Out </a>
                    </li>
                  </ul>
                </div>
                <!-- profile end -->
              </div>
            </div>
          </div>
        </div>
      </header>
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
      <!-- ========== table components end ========== -->

      <!-- ========== footer start =========== -->
      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6 order-last order-md-first">
              <div class="copyright text-center text-md-start">
                <p class="text-sm">
                  Designed and Developed by
                  <a href="https://plainadmin.com" rel="nofollow" target="_blank">
                    PlainAdmin
                  </a>
                </p>
              </div>
            </div>
            <!-- end col-->
            <div class="col-md-6">
              <div class="terms d-flex justify-content-center justify-content-md-end">
                <a href="#0" class="text-sm">Term & Conditions</a>
                <a href="#0" class="text-sm ml-15">Privacy & Policy</a>
              </div>
            </div>
          </div>
          <!-- end row -->
        </div>
        <!-- end container -->
      </footer>
      <!-- ========== footer end =========== -->
    </main>

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
