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
                                <i class="lni lni-users me-2"></i>User Roles
                            </h5>
                            <!-- <p class="text-sm text-muted mt-1 mb-0">
                                For basic styling—light padding and only horizontal dividers—use the class table.
                            </p> -->
                        </div>
                        <button type="button" class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="lni lni-plus me-2"></i>Create
                        </button>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive rounded">
                        <table id="example" class="table table-hover align-middle mb-0" style="width:100%">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4 text-uppercase text-secondary text-xs font-weight-bolder">Name</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Code</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category as $category)
                                    <tr class="border-bottom">
                                        <td class="ps-4">
                                            <p class="mb-0 fw-semibold">
                                                <a href="#0" class="text-decoration-none">{{ $category->name }}</a>
                                            </p>
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ $category->code }}</span>
                                        </td>
                                        <td class="text-end pe-4">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <!-- Edit Category -->
                                                    <li>
                                                        <a href="#editCategoryModal"
                                                           class="dropdown-item edit-btn"
                                                           data-bs-toggle="modal"
                                                           onclick="editCategory('{{ $category->id }}', '{{ $category->name }}', '{{ $category->code }}')">
                                                            <i class="lni lni-pencil me-2"></i>Edit
                                                        </a>
                                                    </li>
                                                    <!-- Delete Category -->
                                                    <li>
                                                        <a href="{{ URL::to('deletecategory', $category->id) }}"
                                                           class="dropdown-item text-danger"
                                                           onclick="return confirm('Are you sure you want to delete this Category?')">
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
            <!-- end card -->
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
       <form action="{{ URL::to('/addcategory') }}" method="POST">
           @csrf
           <div class="modal-body">
            <div class="row gy-4">
               <div class="col-lg-6">
               <input type="text" class="form-control" name="name" placeholder="Category Name" required />
               </div>
               <div class="col-lg-6">
               <input type="number" class="form-control" name="code" placeholder="Category Code" required />
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

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ URL::to('/updatecategory') }}" method="POST">
        @csrf
        @method('POST')
        <input type="hidden" name="id" id="edit-category-id">

        <div class="modal-header">
          <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="row gy-4">
            <div class="col-lg-6">
              <input type="text" class="form-control" name="name" id="edit-category-name" placeholder="Category Name" required />
            </div>
            <div class="col-lg-6">
              <input type="number" class="form-control" name="code" id="edit-category-code" placeholder="Category Code" required />
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
    function editCategory(id, name, code) {
        document.getElementById('edit-category-id').value = id;
        document.getElementById('edit-category-name').value = name;
        document.getElementById('edit-category-code').value = code;
    }
</script>
