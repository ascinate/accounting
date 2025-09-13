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

      <!-- ========= All Javascript files linkup ======== -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/dynamic-pie-chart.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/fullcalendar.js') }}"></script>
    <script src="{{ asset('assets/js/jvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/js/world-merc.js') }}"></script>
    <script src="{{ asset('assets/js/polyfill.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>

    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    console.log("Script Loaded!");

    let grandTotal = 0;

    function updateGrandTotal() {
        let discount = parseFloat($('input[name="discount"]').val()) || 0;
        let total = 0;

        $("#productTable tr").each(function () {
            let rowTotal = parseFloat($(this).find(".row-total").text()) || 0;
            total += rowTotal;
        });

        let finalTotal = total - discount;
        $(".discount-amount").text(`$ ${discount.toFixed(2)}`);
        $(".grand-total").text(`$ ${finalTotal.toFixed(2)}`);
    }

    $("#productSearch").on("keyup", function () {
        console.log("Keyup Event Fired!");
        let query = $(this).val().trim();

        if (query.length > 1) {
            $.ajax({
                url: "{{ route('products.search') }}",
                type: "GET",
                data: { query: query },
                success: function (response) {
                    console.log("Response Received:", response);
                    let dropdown = $("#productDropdown");
                    let tableBody = $("#productTable");
                    dropdown.empty().show();
                    tableBody.empty();

                    if (response.length > 0) {
                        response.forEach((product) => {
                            dropdown.append(`<li><a class="dropdown-item product-item" href="#" data-id="${product.id}" data-code="${product.code}" data-name="${product.name}" data-price="${product.price}" data-stock="${product.stock_alert}" data-type="${product.type}">${product.name}</a></li>`);
                        });
                    } else {
                        dropdown.append('<li class="dropdown-item text-center">No results found</li>');
                        tableBody.append(`
                            <tr>
                                <td colspan="7" class="text-center">No data available</td>
                            </tr>
                        `);
                    }
                },
                error: function () {
                    alert("Error fetching products. Please try again.");
                }
            });
        } else {
            $("#productDropdown").hide();
            $("#productTable").empty().append(`
                <tr>
                    <td colspan="7" class="text-center">No data available</td>
                </tr>
            `);
        }
    });

    $(document).on("click", ".product-item", function (e) {
        e.preventDefault();
        let selectedProduct = $(this).data();
        $("#productSearch").val(selectedProduct.name);
        $("#productDropdown").hide();

        $('input[name="product_id"]').val(selectedProduct.id);

        let tableBody = $("#productTable");

        tableBody.append(`
            <tr>
                <td>#</td>
                <td>${selectedProduct.code}</td>
                <td>${selectedProduct.name}</td>
                <td>${selectedProduct.stock ?? 'N/A'}</td>
                <td><input type="number" class="form-control qty-input" data-price="${selectedProduct.price}" value="1" min="1" /></td>
                <td>${selectedProduct.type ?? 'N/A'}</td>
                <td class="row-total">${parseFloat(selectedProduct.price).toFixed(2)}</td>
            </tr>
        `);

        updateGrandTotal();
    });

    $(document).on("input", ".qty-input", function () {
        let qty = parseFloat($(this).val()) || 1;
        let price = parseFloat($(this).data("price"));
        let total = qty * price;
        $(this).closest("tr").find(".row-total").text(total.toFixed(2));
        updateGrandTotal();
    });

    $(document).on("input", 'input[name="discount"]', function () {
        updateGrandTotal();
    });

      $('form').on('submit', function (e) {
      let qty = parseFloat($("#productTable .qty-input").val()) || 1;
      let price = parseFloat($("#productTable .qty-input").data("price")) || 0;
      let discount = parseFloat($('input[name="discount"]').val()) || 0;
      let totalPrice = qty * price - discount;
      $('#final_quantity').val(qty);
      $('#final_price').val(price.toFixed(2));
      $('#final_totalprice').val(totalPrice.toFixed(2));
  });

});
</script>

<script>
$(document).ready(function () {
    $('.pay-btn').on('click', function (e) {
        const saleid = $(this).data('saleid') || null;
        const purchaseid = $(this).data('purchaseid') || null;
        const total = parseFloat($(this).data('total'));

        $('#modal_saleid').val(saleid);
        $('#modal_purchaseid').val(purchaseid);
        $('#modal_total').text(total.toFixed(2));
        $('#modal_total_input').val(total);

        $('#paymentModal').modal('show');
    });

    $('#paymentForm').on('submit', function (e) {
        const dueAmount = parseFloat($('#modal_total_input').val());
        const payAmount = parseFloat($('#pay_amount').val());

        if (dueAmount <= 0) {
            e.preventDefault();
            alert('Payment already complete.');
            return;
        }

        if (payAmount > dueAmount) {
            e.preventDefault();
            alert('Payment amount cannot be greater than the due amount.');
        }
    });
});
</script>

<script>
  document.getElementById('product-type').addEventListener('change', function () {
    const type = this.value;
    const standardFields = document.querySelectorAll('.standard-only');
    const variableFields = document.querySelectorAll('.variable-only');
    const serviceFields = document.querySelectorAll('.service-only');

    standardFields.forEach(field => field.style.display = 'none');
    variableFields.forEach(field => field.style.display = 'none');
    serviceFields.forEach(field => field.style.display = 'none');

    if (type === 'Standard Product') {
      standardFields.forEach(field => field.style.display = 'block');
    } else if (type === 'Variable Product') {
      variableFields.forEach(field => field.style.display = 'block');
    } else if (type === 'Service Product') {
      serviceFields.forEach(field => field.style.display = 'block');
    }
  });
</script>





    <script>
          new DataTable('#example', {
              responsive: true
          });
    </script>
  </body>
</html>