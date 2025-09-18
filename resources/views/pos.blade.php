<x-adminheader />


           
             <section class="table-components">

                 <div class="container-fluid">
              
                    <div class="d-flex align-items-center">
                        <div class="w-100 text-gray-600 position-relative">
                            <div id="pos-autocomplete" class="autocomplete">
                                   
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="position-absolute top-50 translate-middle left-30 "><path d="M6.41667 11.0833C8.994 11.0833 11.0833 8.994 11.0833 6.41667C11.0833 3.83934 8.994 1.75 6.41667 1.75C3.83934 1.75 1.75 3.83934 1.75 6.41667C1.75 8.994 3.83934 11.0833 6.41667 11.0833Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M12.2499 12.25L9.7124 9.71252" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path></svg>     
                                   
                                        <input type="text" id="posProductSearch" class="form-control" placeholder="Scan/Search Product by code or name">
                                        <ul id="posProductDropdown" class="dropdown-menu w-100"></ul> <!-- List where the product will come -->
                            </div>
                        </div>
                    </div>

                    <div class="row pos-card-left">
                        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                           
                            <form class="pos-form">

                                <!-- card -->
                                <div class="card m-0 card-list-products">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6 class="fw-semibold m-0">Cart</h6>
                                    </div>

                                    <div class="pos-card-items"><!-- Dynamic cart items will be added here --></div>

                                    <div class="cart-summery">
                                        <div>
                                            <div class="summery-item mb-2 row">
                                                <div class="mt-3">
                                                    <label class="fw-semibold">Shipping</label>
                                                    <input type="number" name="pos_shipping" class="form-control pos-shipping" value="0" min="0">
                                                </div>
                                            </div>

                                            <div class="summery-item mb-2 row">
                                                <div class="mt-3">
                                                    <label class="fw-semibold">Order Tax</label>
                                                    <input type="number" name="pos_tax" class="form-control pos-tax" value="0" min="0">
                                                </div>
                                            </div>

                                            <div class="summery-item mb-3 row">
                                                <div class="mt-3">
                                                    <label class="fw-semibold">Discount</label>
                                                    <input type="number" name="pos_discount" class="form-control pos-discount" value="0" min="0">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="pt-3 border-top border-gray-300 summery-total">
                                            <h5 class="summery-item m-0">
                                                <span>Grand Total:</span>
                                                <span class="pos-grand-total">$ 0.00</span>
                                            </h5>
                                        </div>

                                        <div class="half-circle half-circle-left"></div>
                                        <div class="half-circle half-circle-right"></div>
                                    </div>

                                    <button type="submit" class="cart-btn btn btn-primary">
                                        Order Now
                                    </button>
                                </div>

                                <!-- Hidden field for cart data -->
                                <input type="hidden" id="pos_final_cart" name="pos_final_cart">
                            </form>
                        
                        </div>

                        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 mt-3">
                            <div class="row">
                                <div class="col-12 col-lg-8">
                                    <div class="row">

                                        <div class="col-lg-4 col-md-6 col-sm-6" v-for="product in products"
                                            @click="Check_Product_Exist(product , product.id)">
                                            <div class="card product-card cursor-pointer">
                                                <img :src="'/images/products/'+product.image" alt="">
                                                <div class="card-body pos-card-product">
                                                    <p class="text-gray-600"></p>
                                                    <h6 class="title m-0"> </h6>
                                                </div>
                                                <div class="quantity">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center">
                                            <b-pagination @change="Product_onPageChanged" :total-rows="product_totalRows"
                                                :per-page="product_perPage" v-model="product_currentPage">
                                            </b-pagination>
                                        </div>

                                    </div>
                                </div>

                                <div class="d-md-block col-12 col-lg-4">
                                    <div class="card category-card">
                                        <div class="category-head">
                                            <h5 class="fw-semibold m-0">All Category</h5>
                                        </div>
                                        <ul class="p-0">
                                            <li class="category-item" @click="Selected_Category('')" :class="{ 'active': category_id === '' }">
                                                <i class="i-Bookmark"></i> All Category
                                            </li>
                                            <li class="category-item" @click="Selected_Category(category.id)" v-for="category in categories" :key="category.id" :class="{ 'active': category.id === category_id }">
                                                <i class="i-Bookmark"></i>
                                            </li>
                                        </ul>
                                        <nav aria-label="Page navigation example mt-3">
                                            <ul class="pagination justify-content-center">
                                                <li class="page-item" :class="{ 'disabled': currentPage_cat == 1 }">
                                                    <a class="page-link" href="#" aria-label="Previous" @click.prevent="previousPage_Category">
                                                        <span aria-hidden="true">&laquo;</span>
                                                    </a>
                                                </li>
                                                <li class="page-item" v-for="i in pages_cat" :key="i" :class="{ 'active': currentPage_cat == i }">
                                                    <a class="page-link" href="#" @click.prevent="goToPage_Category(i)"></a>
                                                </li>
                                                <li class="page-item" :class="{ 'disabled': currentPage_cat == pages_cat }">
                                                    <a class="page-link" href="#" aria-label="Next" @click.prevent="nextPage_Category">
                                                        <span aria-hidden="true">&raquo;</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>

                                    </div>

                                    <div class="card category-card">
                                        <div class="category-head">
                                            <h5 class="fw-semibold m-0">All brands</h5>
                                        </div>
                                        <ul class="p-0">
                                            <li class="category-item" @click="Selected_Brand('')" :class="{ 'active': brand_id === '' }">
                                                <i class="i-Bookmark"></i> All brands
                                            </li>
                                            <li class="category-item" @click="Selected_Brand(brand.id)" v-for="brand in brands" :key="brand.id" :class="{ 'active': brand.id === brand_id }">
                                                <i class="i-Bookmark"></i>
                                            </li>
                                        </ul>
                                        <nav aria-label="Page navigation example mt-3">
                                            <ul class="pagination justify-content-center">
                                                <li class="page-item" :class="{ 'disabled': currentPage_brand == 1 }">
                                                    <a class="page-link" href="#" aria-label="Previous" @click.prevent="previousPage_brand">
                                                        <span aria-hidden="true">&laquo;</span>
                                                    </a>
                                                </li>
                                                <li class="page-item" v-for="i in pages_brand" :key="i" :class="{ 'active': currentPage_brand == i }">
                                                    <a class="page-link" href="#" @click.prevent="goToPage_brand(i)"></a>
                                                </li>
                                                <li class="page-item" :class="{ 'disabled': currentPage_brand == pages_brand }">
                                                    <a class="page-link" href="#" aria-label="Next" @click.prevent="nextPage_brand">
                                                        <span aria-hidden="true">&raquo;</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                 </div>
            </section>










<x-adminfooter />