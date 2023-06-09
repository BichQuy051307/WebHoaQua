<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\AuthAdmin\LoginController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\LoginController as CustomerLoginController;
use App\Http\Controllers\Customer\LogoutController as CustomerLogoutController;
use App\Http\Controllers\Customer\RegisterController;
use App\Http\Controllers\Customer\AccountController;
use App\Http\Controllers\Customer\ChangePasswordController;
use App\Http\Controllers\Customer\WishlistController;
use App\Http\Controllers\Customer\OrderHistoryController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\ProductController as CustomerProductController;

Auth::routes();

Route::get('/', function () {
    return view('home');
});
// login
Route::get('/login', function () {
    return view('login');
});
// logout
Route::get('/logout', [CustomerLogoutController::class, 'logout']);
// login
Route::post('/login', [CustomerLoginController::class, 'postLogin']);
// singup
Route::get('/register', function () {
    return view('register');
});

Route::post('/register', [RegisterController::class, 'register']);
Route::get('/danh-muc/{slug}', [CustomerProductController::class, 'index']);

// search product
Route::get('/search', [HomeController::class, 'search']);

// cart
Route::post('/add/item', [CartController::class, 'addSpecialItem']);
Route::get('/checkout/cart', [CartController::class, 'index']);
Route::post('/checkout/cart', [CartController::class, 'addItem']);
Route::delete('/remove-cart/{id}', [CartController::class, 'remove']);
Route::get('/clear/cart', [CartController::class, 'clearCart']);
// increment
Route::post('/increment/cart', [CartController::class, 'increment']);
// decrement
Route::post('/decrement/cart', [CartController::class, 'decrement']);
Route::get('/checkout/cart/item/number', [CartController::class, 'getItemNumber']);

// checkout payment
Route::get('/checkout/payment', [CheckoutController::class, 'index']);
Route::post('/checkout/payment', [CheckoutController::class, 'order']);

// order-received
Route::get('/checkout/order-received/{order_id}', [CheckoutController::class, 'orderReceived']);

Route::get('/san-pham/{slug}', [HomeController::class, 'productDetail']);

Route::group(['prefix' => '/', 'middleware' => 'CheckUserLogin'], function () {
    // my account
    Route::get('/my/account/{user_id}', [AccountController::class, 'myAccount']);
    // update account information
    Route::post('/my/account', [AccountController::class, 'updateMyAccount']);
    // change password
    Route::get('/change/password', [ChangePasswordController::class, 'getFormChangePassword']);
    Route::post('/change/password', [ChangePasswordController::class, 'changePassword']);
    // wishlist
    Route::get('/wishlist', [WishlistController::class, 'index']);
    Route::delete('/remove-wishlist/{id}', [WishlistController::class, 'delete']);
    // my orders
    Route::get('/order/history/{user_id}', [OrderHistoryController::class, 'myOrder']);
    // order detail 
    Route::get('/order/detail/{user_id}', [OrderHistoryController::class, 'myOrderDetail']);
});

Route::post('/wishlist', [WishlistController::class, 'addWishlist']);

Route::get('/gioi-thieu', function () {
	return view('introduction');
});

// Create route for admin dashboard
// Route::get('/admin/login', function () {
//     return view('admin.login');
// });
// Route::get('/admin/dashboard', function () {
//     return view('admin.dashboard');
// });
Route::get('/admin/table', function () {
    return view('admin.basic-table');
});

Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [LoginController::class, 'postLoginAdmin']);
// admin
Route::group([
    'prefix' => 'admin',
    'middleware' => 'auth:admin',
], function () {
    Route::group([
        'middleware' => 'isAdmin',
    ], function () {
        Route::get('/logout', [LoginController::class, 'logoutAdmin']);
        // categories
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        });
        Route::resource('category', CategoryController::class);
        Route::post('/update-category', [CategoryController::class, 'edit']);
        Route::get('/new/category', function () {
            return view('admin.category.new-category');
        });

        // products
        Route::resource('product', ProductController::class);
        Route::post('/update-product', [ProductController::class, 'edit']);
        Route::get('/new/product', function () {
            return view('admin.product.new-product');
        });

        // users
        Route::resource('user', UserController::class);
        Route::post('/update-user', [UserController::class, 'edit']);

        // orders
        Route::get('/order', [OrderController::class, 'index']);
        Route::get('/order/{order_id}', [OrderController::class, 'show']);
        Route::get('/order_note/{id}', [OrderController::class, 'note']);
        Route::put('/order/{id}', [OrderController::class, 'update']);
        Route::put('/order/cancel/{id}', [OrderController::class, 'cancelOrder']);
        // Route::delete('/order/{id}', [OrderController::class, 'destroy']);
        Route::get('/order_pending', [OrderController::class, 'pending']);
        Route::get('/order_shipped', [OrderController::class, 'shipped']);
        Route::get('/order_delivered', [OrderController::class, 'delivered']);
        Route::get('/order_cancel', [OrderController::class, 'cancel']);
    });
});
