<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//Frontend
Route::get('/news', function () {
    return view('news');
});
Route::get('/home', function () {
    return view('welcome');

});
Route::get('/news', function () {
    return view('news');

});
Route::get('/introduce', function () {
    return view('introduce');

});


Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/product', [HomeController::class, 'product']);
Route::post('/search', [HomeController::class, 'search']);

// Category products - home
Route::get('/category-products/{cate_id}', [CategoryProduct::class, 'show_cate_home']);
Route::get('/product-detail/{product_id}', [ProductController::class, 'product_detail']);


//Backend
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'show_dashboard']);
Route::post('/admin_dashboard', [AdminController::class, 'dashboard']);
Route::get('/logout', [AdminController::class, 'logout']);
Route::post('/admin_search', [AdminController::class, 'admin_search']);
Route::post('/search_customer', [AdminController::class, 'search_customer']);



//Category product
Route::get('/add-category-product', [CategoryProduct::class, 'add_category_product']);
Route::get('/list-category-product', [CategoryProduct::class, 'list_category_product']);
Route::get('/edit-category-product/{category_id}', [CategoryProduct::class, 'edit_category_product']);
Route::get('/delete-category-product/{category_id}', [CategoryProduct::class, 'delete_category_product']);
Route::post('/update-category-product/{category_id}', [CategoryProduct::class, 'update_category_product']);
Route::post('/category-product', [CategoryProduct::class, 'save_category_product']);
Route::get('/on-cate/{category_id}', [CategoryProduct::class, 'on_cate']);
Route::get('/off-cate/{category_id}', [CategoryProduct::class, 'off_cate']);

Route::post('/import-csv', [CategoryProduct::class, 'import_csv']);
Route::post('/export-csv', [CategoryProduct::class, 'export_csv']);

//Product
Route::get('/add-product', [ProductController::class, 'add_product']);
Route::get('/list-product', [ProductController::class, 'list_product']);
Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product']);
Route::get('/delete-product/{product_id}', [ProductController::class, 'delete_product']);
Route::post('/update-product/{product_id}', [ProductController::class, 'update_product']);
Route::post('/save-product', [ProductController::class, 'save_product']);
Route::get('/on-pro/{product_id}', [ProductController::class, 'on_pro']);
Route::get('/off-pro/{product_id}', [ProductController::class, 'off_pro']);

Route::post('/import-product', [ProductController::class, 'import_product']);
Route::post('/export-product', [ProductController::class, 'export_product']);

//Cart
Route::post('/save-cart', [CartController::class, 'save_cart']);
Route::post('/save-cartt', [CartController::class, 'save_cartt']);
Route::get('/show-cart', [CartController::class, 'show_cart']);
Route::get('/delete-to-cart/{session_id}', [CartController::class, 'delete_to_cart']);
Route::post('/update-quantity-cart', [CartController::class, 'update_quantity_cart']);
Route::post('/reduce-to-cart', [CartController::class, 'reduce_to_cart']);
//ajax
Route::post('/add-cart-ajax', [CartController::class, 'add_cart_ajax']);
Route::get('/show-cart-ajax', [CartController::class, 'show_cart_ajax']);
Route::get('/delete-all-cart', [CartController::class, 'delete_all_cart']);


//Checkout

Route::get('/login-checkout', [CheckoutController::class, 'login_checkout']);
Route::get('/sign-up', [CheckoutController::class, 'sign_up']);
Route::get('/login', [CheckoutController::class, 'login']);
Route::post('/login-customer', [CheckoutController::class, 'login_customer']);
Route::get('/log-out', [CheckoutController::class, 'log_out']);
Route::post('/add-customer', [CheckoutController::class, 'add_customer']);
Route::get('/check-out', [CheckoutController::class, 'check_out']);
Route::get('/delete-to-checkout/{id}', [CheckoutController::class, 'delete_to_checkout']);
Route::post('/save-checkout', [CheckoutController::class, 'save_checkout']);
Route::get('/payment', [CheckoutController::class, 'payment']);
Route::post('/order', [CheckoutController::class, 'order']);
Route::get('/manage-customer', [CheckoutController::class, 'manage_customer']);
//ajax
Route::post('/confirm-order', [CheckoutController::class, 'confirm_order']);



//Order
Route::get('/manage-order', [OrderController::class, 'manage_order']);
Route::get('/view-order/{order_id}', [OrderController::class, 'view_order']);
Route::get('/wait-pay/{order_id}', [OrderController::class, 'wait_pay']);
Route::get('/delivery/{order_id}', [OrderController::class, 'delivery']);
Route::get('/success-delivery/{order_id}', [OrderController::class, 'success_delivery']);
Route::get('/cancel/{order_id}', [OrderController::class, 'cancel']);
Route::get('/delivery-failed/{order_id}', [OrderController::class, 'delivery_failed']);

Route::post('/update-quantity-order', [OrderController::class, 'update_quantity_order']);
Route::post('/update-qty-order', [OrderController::class, 'update_qty_order']);
Route::get('/print-order/{checkout_code}', [OrderController::class, 'print_order']);

Route::get('/ordered/{customerId}', [OrderController::class, 'ordered']);
Route::get('/view-ordered/{order_id}', [OrderController::class, 'view_ordered']);

Route::post('/cancel-order', [OrderController::class, 'cancel_order']);
Route::post('/cancel-order-customer', [OrderController::class, 'cancel_order_customer']);
Route::post('/accept-order', [OrderController::class, 'accept_order']);

//Send Mail
Route::get('/send-mail', [HomeController::class, 'send_mail']);

//Login FB
Route::get('/login-facebook', [AdminController::class, 'login_facebook']);
Route::get('/admin/callback', [AdminController::class, 'call_back']);

Route::get('/wait-pay', [AdminController::class, 'wait_pay']);
Route::get('/delivery', [AdminController::class, 'delivery']);
Route::get('/success-delivery', [AdminController::class, 'success_delivery']);
Route::get('/cancel', [AdminController::class, 'cancel']);
Route::get('/delivery-failed', [AdminController::class, 'delivery_failed']);


