<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\OrderReviewController;

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
Route::post('/search_order', [AdminController::class, 'search_order']);
Route::post('/search-access', [AdminController::class, 'search_access']);
Route::post('/search-comment', [AdminController::class, 'search_comment']);
Route::post('/search-review', [AdminController::class, 'search_review']);
Route::post('/filter-by-date', [AdminController::class, 'filter_by_date']);
Route::post('/dashboard-filter', [AdminController::class, 'dashboard_filter']);
Route::post('/days-order', [AdminController::class, 'days_order']);


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
Route::group(['middleware' => 'auth.role', 'auth.role' =>['admin', 'editor'] ], function(){
    Route::get('/list-product', [ProductController::class, 'list_product']);
    Route::post('/save-product', [ProductController::class, 'save_product']);

});
Route::get('/delete-product/{product_id}', [ProductController::class, 'delete_product']);
Route::post('/update-product/{product_id}', [ProductController::class, 'update_product']);
Route::get('/on-pro/{product_id}', [ProductController::class, 'on_pro']);
Route::get('/off-pro/{product_id}', [ProductController::class, 'off_pro']);
Route::post('/import-product', [ProductController::class, 'import_product']);
Route::post('/export-product', [ProductController::class, 'export_product']);

Route::post('/load-comment', [ProductController::class, 'load_comment']);
Route::post('/send-comment', [ProductController::class, 'send_comment']);

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
Route::post('/update-size-cart', [CartController::class, 'update_size_cart']);


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
Route::group(['middleware' => 'auth.role', 'auth.role' =>['admin', 'editor'] ], function(){
    Route::get('/manage-order', [OrderController::class, 'manage_order']);
    Route::get('/view-order/{order_id}', [OrderController::class, 'view_order']);
});
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


//Customer
Route::get('/customer/{customerId}', [CustomerController::class, 'customer']);
Route::get('/address/{customerId}', [CustomerController::class, 'address']);

//Authentication role
Route::get('/register-admin', [AuthController::class, 'register_admin']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login-admin', [AuthController::class, 'login_admin']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout-admin', [AuthController::class, 'logout_admin']);

//
Route::get('/all-permission', [UserController::class, 'index'])->middleware('auth.role');
Route::get('/add-permission', [UserController::class, 'add_permission']);
Route::post('/store-users', [UserController::class, 'store_users']);
Route::post('/assign-roles', [UserController::class, 'assign_roles'])->middleware('auth.role');

Route::group(['middleware' => 'auth.role' ], function(){
    Route::get('/add-product', [ProductController::class, 'add_product']);
    Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product']);

});
//Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product'])->middleware('auth.role');
//Route::group(['middleware' => 'auth.role', 'auth.role' =>['admin', 'editor'] ], function(){
 //   Route::get('/add-product', [ProductController::class, 'add_product']);

//});
Route::get('/delete-roles/{admin_id}', [UserController::class, 'delete_roles'])->middleware('auth.role');

Route::get('/manage-comment', [CommentController::class, 'manage_comment']);
Route::post('/approve-comment', [CommentController::class, 'approve_comment']);
Route::post('/reply-comment', [CommentController::class, 'reply_comment']);
Route::get('/comment-not-approved', [CommentController::class, 'comment_not_approved']);
Route::get('/comment-approved', [CommentController::class, 'comment_approved']);

Route::post('/load-review', [OrderReviewController::class, 'load_review']);
Route::post('/send-review', [OrderReviewController::class, 'send_review']);
