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


<!--Table wrapper start-->
<div class="tables-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4 border-0 shadow">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0 fw-bold text-primary">
                                <i class="lni lni-box me-2"></i>Product Management
                            </h5>
                        </div>
                        <div class="d-flex gap-2">
                            <!-- Create Button -->
                            <button type="button" class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="lni lni-plus me-2"></i>Create Product
                            </button>
                            
                            <!-- Export Dropdown -->
                            <div class="dropdown">
                                <button class="btn btn-success px-4 dropdown-toggle" type="button" id="exportDropdown" 
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="lni lni-download me-2"></i>Export
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="exportDropdown">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center py-2" href="{{ url('/product/export/excel') }}">
                                            <i class="lni lni-file-excel me-2 text-success"></i>
                                            <span>Excel (CSV)</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center py-2" href="{{ url('/product/export/pdf') }}">
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
                                    <th class="ps-4 text-uppercase text-secondary text-xs font-weight-bolder">Image</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Name</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Type</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Code</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr class="border-bottom">
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                @if($product->image)
                                                    <img src="{{ asset('uploads/' . $product->image) }}" alt="Product" 
                                                         class="rounded border" width="60" height="60">
                                                @else
                                                    <div class="avatar-placeholder rounded bg-light text-secondary d-flex align-items-center justify-content-center" 
                                                         style="width:60px;height:60px;">
                                                        <i class="lni lni-box fs-5"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-semibold">{{ $product->name }}</p>
                                    </td>
                                    <td>
                                        <span class="badge bg-info bg-opacity-10 text-info px-3 py-1 rounded-pill">
                                            {{ $product->type }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $product->code }}</span>
                                    </td>
                                      <td>
  <div class="dropdown">
    <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
      Actions
    </button>
    <ul class="dropdown-menu">
      <!-- Edit Product -->
      <li>
        <a href="#"
           class="dropdown-item edit-btn"
           data-bs-toggle="modal"
           data-bs-target="#editProductModal"
           data-id="{{ $product->id }}"
           data-name="{{ $product->name }}"
           data-code="{{ $product->code }}"
           data-category="{{ $product->category }}"
           data-brand="{{ $product->brand }}"
           data-gst="{{ $product->gst }}"
           data-taxmethod="{{ $product->taxmethod }}"
           data-type="{{ $product->type }}"
           data-price="{{ $product->price }}"
           data-unit_name="{{ $product->unit_name }}"
           data-unit_sale="{{ $product->unit_sale }}"
           data-unit_purchase="{{ $product->unit_purchase }}"
           data-quantity="{{ $product->quantity }}"
           data-stock_alert="{{ $product->stock_alert }}"
           data-otherdetails="{{ $product->otherdetails }}">
          <i class="lni lni-pencil-alt me-2"></i>Edit
        </a>
      </li>
      
      <!-- Delete Product -->
      <li>
        <a href="{{ URL::to('deleteproducts', $product->id) }}"
           class="dropdown-item text-danger"
           onclick="return confirm('Are you sure you want to delete this Product?')">
          <i class="lni lni-trash-can me-2"></i>Delete
        </a>
      </li>
    </ul>
  </div>
</td>
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

      <x-adminfooter/>

  


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-lg">

          <div class="modal-content">

          <div class="modal-header">

              <h5 class="modal-title" id="exampleModalLabel">Add New Record</h5>

              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

          </div>

          <form action="{{ URL::to('/addproducts') }}" method="POST" enctype="multipart/form-data">

              @csrf

              <div class="modal-body">

                <div class="cmvb-div bg-white p-4">

                    <div class="row gy-4">

                        <div class="col-lg-6">

                         

                         <input type="text" class="form-control" name="name" placeholder="Product Name"  required />

                        </div>

                        <div class="col-lg-6">

                         <input type="number" class="form-control" name="code" placeholder="Product Code" required />

                        </div>

                        <div class="col-lg-6">

                          <select class="form-control" name="category" required>
                                   <option value="" disabled selected>Choose Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                                    @endforeach
                          </select>
                        </div>

                        <div class="col-lg-6">

                          <select class="form-control" name="brand" required>

                              <option value="" disabled selected>Choose Brand</option>

                              <option value="Source">Source</option>

                              <option value="Brand Electronices">Brand Electronices</option>

                              <option value="Brand Shoes">Brand Shoes</option>

                          </select>

                        </div>

                        

                        <div class="col-lg-6">

                         <input type="number" class="form-control" name="gst" placeholder="Order Tax" required />

                        </div>

                        <div class="col-lg-6">

                          <select class="form-control" name="taxmethod" required>

                              <option value="" disabled selected>Choose Method</option>

                              <option value="Exclusive">Exclusive</option>

                              <option value="Inclusive">Inclusive</option>

                             

                          </select>

                        </div>

                        <div class="col-lg-6">

                          <input class="form-control" type="file" name="image" id="image" />

                        </div>

        

                        <div class="col-lg-6">

                          <label class="form-label">Please provide any details </label>

                          <textarea class="form-control desiri derty2" name="otherdetails" required></textarea>

                        </div>

                       

                    </div>

                    

                </div>



                <div class="cmvb-div bg-white p-4">

                  <div class="row gy-4">

                    <div class="col-lg-6">

                      <select class="form-control" name="type" id="product-type" required>

                        <option value="" disabled selected>Product Type</option>

                        <option value="Standard Product">Standard Product</option>

                        <option value="Variable Product">Variable Product</option>

                        <option value="Service Product">Service Product</option>

                      </select>

                    </div>



                  

                    <div class="col-lg-6 standard-only">

                      <input type="number" class="form-control" name="price" placeholder="Product Price" required />

                    </div>



                

                    <div class="col-lg-6 standard-only variable-only">

                      <input type="text" class="form-control" name="unit_name" placeholder="Product Unit" required />

                    </div>



                   

                    <div class="col-lg-6 standard-only variable-only">

                      <input type="text" class="form-control" name="unit_sale" placeholder="Unit Sale" required />

                    </div>



                  

                    <div class="col-lg-6 standard-only variable-only">

                      <input class="form-control" type="text" name="unit_purchase" id="unit_purchase" placeholder="Unit Purchase" required />

                    </div>



                   

                    <div class="col-lg-6 standard-only variable-only service-only">

                      <input class="form-control" type="number" name="quantity" id="quantity" placeholder="Product Quantity" required />

                    </div>



                 

                    <div class="col-lg-6 standard-only variable-only service-only">

                      <input class="form-control" type="number" name="stock_alert" id="stock_alert" placeholder="Stock Alert" required />

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

   <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="{{ URL::to('/updateproduct') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" id="edit-id">

        <div class="modal-header">
          <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="cmvb-div bg-white p-4">
            <div class="row gy-4">
              <div class="col-lg-6">
                <input type="text" class="form-control" name="name" id="edit-name" placeholder="Product Name" required />
              </div>
              <div class="col-lg-6">
                <input type="number" class="form-control" name="code" id="edit-code" placeholder="Product Code" required />
              </div>
              <div class="col-lg-6">
               <select class="form-control" name="category" id="edit-category" required>
                    <option value="" disabled>Choose Category</option>
                                  @foreach($categories as $category)
                                      <option value="{{ $category->name }}">{{ $category->name }}</option>
                                  @endforeach
                    </select>
              </div>
              <div class="col-lg-6">
                <select class="form-control" name="brand" id="edit-brand" required>
                  <option value="" disabled>Choose Brand</option>
                  <option value="Source">Source</option>
                  <option value="Brand Electronices">Brand Electronices</option>
                  <option value="Brand Shoes">Brand Shoes</option>
                </select>
              </div>
              <div class="col-lg-6">
                <input type="number" class="form-control" name="gst" id="edit-gst" placeholder="Order Tax" required />
              </div>
              <div class="col-lg-6">
                <select class="form-control" name="taxmethod" id="edit-taxmethod" required>
                  <option value="" disabled>Choose Method</option>
                  <option value="Exclusive">Exclusive</option>
                  <option value="Inclusive">Inclusive</option>
                </select>
              </div>
              <div class="col-lg-6">
                <input class="form-control" type="file" name="image" />
              </div>
              <div class="col-lg-6">
                <label class="form-label">Please provide any details</label>
                <textarea class="form-control desiri derty2" name="otherdetails" id="edit-otherdetails" required></textarea>
              </div>
            </div>
          </div>

          <div class="cmvb-div bg-white p-4">
            <div class="row gy-4">
              <div class="col-lg-6">
                <select class="form-control" name="type" id="edit-type" required>
                  <option value="" disabled>Product Type</option>
                  <option value="Standard Product">Standard Product</option>
                  <option value="Variable Product">Variable Product</option>
                  <option value="Service Product">Service Product</option>
                </select>
              </div>

              <div class="col-lg-6 standard-only">
                <input type="number" class="form-control" name="price" id="edit-price" placeholder="Product Price" required />
              </div>

              <div class="col-lg-6 standard-only variable-only">
                <input type="text" class="form-control" name="unit_name" id="edit-unit_name" placeholder="Product Unit" required />
              </div>

              <div class="col-lg-6 standard-only variable-only">
                <input type="text" class="form-control" name="unit_sale" id="edit-unit_sale" placeholder="Unit Sale" required />
              </div>

              <div class="col-lg-6 standard-only variable-only">
                <input type="text" class="form-control" name="unit_purchase" id="edit-unit_purchase" placeholder="Unit Purchase" required />
              </div>

              <div class="col-lg-6 standard-only variable-only service-only">
                <input class="form-control" type="number" name="quantity" id="edit-quantity" placeholder="Product Quantity" required />
              </div>

              <div class="col-lg-6 standard-only variable-only service-only">
                <input class="form-control" type="number" name="stock_alert" id="edit-stock_alert" placeholder="Stock Alert" required />
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
document.querySelectorAll('.edit-btn').forEach(button => {
  button.addEventListener('click', function () {
    document.getElementById('edit-id').value = this.dataset.id;
    document.getElementById('edit-name').value = this.dataset.name;
    document.getElementById('edit-code').value = this.dataset.code;
    document.getElementById('edit-category').value = this.dataset.category;
    document.getElementById('edit-brand').value = this.dataset.brand;
    document.getElementById('edit-gst').value = this.dataset.gst;
    document.getElementById('edit-taxmethod').value = this.dataset.taxmethod;
    document.getElementById('edit-otherdetails').value = this.dataset.otherdetails;
    document.getElementById('edit-type').value = this.dataset.type;
    document.getElementById('edit-price').value = this.dataset.price;
    document.getElementById('edit-unit_name').value = this.dataset.unit_name;
    document.getElementById('edit-unit_sale').value = this.dataset.unit_sale;
    document.getElementById('edit-unit_purchase').value = this.dataset.unit_purchase;
    document.getElementById('edit-quantity').value = this.dataset.quantity;
    document.getElementById('edit-stock_alert').value = this.dataset.stock_alert;
  });
});


</script>
