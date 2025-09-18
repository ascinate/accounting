<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleDetailController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseDetailController;
use App\Http\Controllers\AccountingController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AdjustmentController;
use App\Http\Controllers\PosController;
use App\Http\Middleware\RolePermission;


Route::get('/', function () {
    return view('admin_login');
});
Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware(RolePermission::class);

Route::view('/login','admin_login');
Route::post('adminlogin', [AdminController::class, 'adminlogin']);
Route::post('user/changepassword', [AdminController::class, 'changePassword']);

Route::get('/logout', [AdminController::class, 'logout']);
Route::post('/admin/dashboard', [UserController::class, 'login']);


Route::middleware(RolePermission::class)->group(function () {
        Route::get('/user', [UserController::class, 'viewuser']);
        Route::post('/add-record', [UserController::class, 'store']);
        Route::post('/update-user', [UserController::class, 'update'])->name('user.update');
     
        Route::get('/user/export/excel', [UserController::class, 'exportExcel'])->name('user.export.excel');
        Route::get('/user/export/pdf', [UserController::class, 'exportPDF'])->name('user.export.pdf');
        Route::get('/role', [UserController::class, 'viewrole']);
        Route::post('/add-role', [UserController::class, 'storerole']);
        Route::get('/deleterole/{id}', [UserController::class, 'roledestroy']);
        Route::get('/role/export/excel', [UserController::class, 'exportExcelrole'])->name('role.export.excel');
        Route::get('/role/export/pdf', [UserController::class, 'exportPDFrole'])->name('role.export.pdf');




        Route::get('/products', [ProductController::class, 'view']);
        Route::post('/addproducts', [ProductController::class, 'store']);
        Route::post('/updateproduct', [ProductController::class, 'update']);
        Route::get('/product/export/excel', [ProductController::class, 'exportExcel'])->name('product.export.excel');
        Route::get('/product/export/pdf', [ProductController::class, 'exportPDF'])->name('product.export.pdf');
        Route::get('/deleteproducts/{id}', [ProductController::class, 'destroy']);

        
        Route::get('/customers', [CustomerController::class, 'view']);
        Route::post('/addcustomers', [CustomerController::class, 'store']);
        Route::post('/updatecustomers', [CustomerController::class, 'update']);
        Route::get('/customerdetails/{id}', [CustomerController::class, 'show']);
        Route::get('/customer/export/excel', [CustomerController::class, 'exportExcel'])->name('customer.export.excel');
        Route::get('/customer/export/pdf', [CustomerController::class, 'exportPDF'])->name('customer.export.pdf');
        Route::get('/deletcustomers/{id}', [CustomerController::class, 'destroy']);
     

        Route::get('/suppliers', [SupplierController::class, 'view']);
        Route::post('/addsuppliers', [SupplierController::class, 'store']);
        Route::post('/updatesuppliers', [SupplierController::class, 'update']);
        Route::get('/supplier/export/excel', [SupplierController::class, 'exportExcel'])->name('supplier.export.excel');
        Route::get('/supplier/export/pdf', [SupplierController::class, 'exportPDF'])->name('supplier.export.pdf');
        Route::get('/supplierdetails/{id}', [SupplierController::class, 'show'])->name('supplier.details');
        Route::get('/deletesuppliers/{id}', [SupplierController::class, 'destroy']);





        Route::get('/adjustments', [AdjustmentController::class, 'view']);
        Route::post('/addadjustment', [AdjustmentController::class, 'store'])->name('adjustments.store');
        Route::post('adjustments/update/{id}', [AdjustmentController::class, 'update'])->name('adjustments.update');
        Route::get('/deleteadjustment/{id}', [AdjustmentController::class, 'destroy'])->name('adjustments.destroy');
        Route::get('/search-products', [AdjustmentController::class, 'search'])->name('products.search');


        Route::get('/warehouse', [WarehouseController::class, 'view']);
        Route::post('/addwarehouse', [WarehouseController::class, 'store']);
        Route::post('/updatewarehouse', [WarehouseController::class, 'update']);
        Route::get('/deletewarehouse/{id}', [WarehouseController::class, 'destroy']);


        Route::get('/category', [CategoryController::class, 'view']);
        Route::post('/addcategory', [CategoryController::class, 'store']);
        Route::post('/updatecategory', [CategoryController::class, 'update']);
        Route::get('/deletecategory/{id}', [CategoryController::class, 'destroy']);

        Route::get('/purchases', [PurchaseController::class, 'view'])->name('purchases');
      
        // Route::post('/updatepurchase', [PurchaseController::class, 'update']);
        // Route::post('/updatepurchase', [PurchaseController::class, 'update']);
        // Route::get('/getpurchase/{id}', [PurchaseController::class, 'getPurchaseData']);
        Route::get('/editpurchase/{id}', [PurchaseController::class, 'edit'])->name('purchase.edit');
        Route::match(['put', 'post'], '/updatepurchase/{id}', [PurchaseController::class, 'update'])->name('purchase.update');


   // Route::get('/getpurchase/{id}', [PurchaseController::class, 'getPurchaseData']);

        Route::post('/addpurchases', [PurchaseController::class, 'store']);
        Route::get('/deletepurchases/{id}', [PurchaseController::class, 'destroy']);
       
        // Route::post('/updatepurchase', [PurchaseController::class, 'update']);




Route::get('/sales', [SaleController::class, 'view'])->name('sales');
Route::post('/addsales', [SaleController::class, 'store']);
Route::get('/editsale/{id}', [SaleController::class, 'edit'])->name('sale.edit');
Route::match(['put', 'post'], '/updatesales/{id}', [SaleController::class, 'update'])->name('sale.update');
Route::get('/deletesales/{id}', [SaleController::class, 'destroy']);

        Route::get('/accounts', [AccountController::class, 'view']);
        Route::post('/addaccounts', [AccountController::class, 'store']);
        Route::post('/updateaccount', [AccountController::class, 'update']);
        Route::get('/deleteaccounts/{id}', [AccountController::class, 'accdestroy']);


        Route::get('/deposits', [AccountController::class, 'deposits']);
        Route::post('/adddeposit', [AccountController::class, 'adddeposit']);
        Route::post('/updatedeposit/{id}', [AccountController::class, 'updatedeposit']);

        Route::get('/deletedeposits/{id}', [AccountController::class, 'depodestroy']);


        Route::get('/expenses', [AccountController::class, 'expenses']);
        Route::post('/addexpense', [AccountController::class, 'addexpense']);
        Route::post('/updateexpense', [AccountController::class, 'updateexpense']);
      
        Route::get('/deleteexpenses/{id}', [AccountController::class, 'exdestroy']);


        Route::get('/payment_methods', [PaymentMethodController::class, 'view']);
        Route::post('/updatepayment', [PaymentMethodController::class, 'update']);
        Route::post('/addpayment', [PaymentMethodController::class, 'store']);
        Route::get('/deletepayment/{id}', [PaymentMethodController::class, 'destroy']);

        Route::get('/transfer', [TransferController::class, 'view']);
        Route::post('/addtransfer', [TransferController::class, 'store']);
        Route::post('/updatetransfer', [TransferController::class, 'updatetransfer']);
      Route::get('/deletetransfer/{id}', [TransferController::class, 'destroy']);

        Route::get('/quotations', [TransferController::class, 'quotationview']);
        Route::post('/addquotations', [TransferController::class, 'addquotations']);
        Route::post('/updatequotation', [TransferController::class, 'updatequotation']);
        Route::get('/deletequotation/{id}', [TransferController::class, 'quodestroy']);

        Route::get('/settings', [SettingController::class, 'settings']);
        Route::post('/addsettings', [SettingController::class, 'storeSettings']);
        Route::get('/deletesettings/{id}', [SettingController::class, 'destroy']);

       


        Route::get('/currency', [SettingController::class, 'currency']);
        Route::post('/addcurrency', [SettingController::class, 'storeCurrency']);
         Route::post('/updatecurrency', [SettingController::class, 'updateCurrency']);
        Route::get('/deletecurrency/{id}', [SettingController::class, 'destroyCurrency']);



        Route::get('/profile', [UserController::class, 'editprofile']);



        Route::post('/createpayment', [PaymentMethodController::class, 'createPayment']);
        
        Route::get('/download-pdf/{id}', [SaleController::class, 'downloadPDF']);

        Route::get('/purchase-download-pdf/{id}', [PurchaseController::class, 'downloadPDF']);

        Route::get('/pos',[PosController::class, 'view']);




});

















