<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ImportProductController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Client\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Client\UserController;
use App\Http\Controllers\Client\AuthUserController;


use App\Http\Controllers\Admin\LoginController;
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

//Route::get('/', function () {
//    return view('welcome');
//});



use App\Http\Controllers\Client\PaypalController;



Auth::routes();
//Route Admin
Route::get('/admin/login', [LoginController::class, 'index'])->name('login_admin');//name :tên router
Route::post('/admin/login/check', [LoginController::class, 'check'])->name('check_login_admin');

Route::middleware('auth:admin')->group(function (){
    Route::get('/admin', [MainController::class, 'index'])->name('admin');
    Route::get('/admin/main', [MainController::class, 'index'])->name('admin_main');

    //Hàng Hóa
    Route::prefix('admin/goods')->group(function (){
        //Danh mục
        Route::prefix('category')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('category');
            Route::get('add', [CategoryController::class, 'add']);
            Route::post('add', [CategoryController::class, 'store']);
            Route::get('edit/{loaisp}', [CategoryController::class, 'edit']);
            Route::post('edit/{loaisp}', [CategoryController::class, 'update']);
            Route::get('delete/{id}', [CategoryController::class, 'delete']);
        });
        //Sản phẩm và mẫu mã sản phẩm
        Route::prefix('product')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('product');
            Route::get('add', [ProductController::class, 'add']);
            Route::post('add', [ProductController::class, 'store']);
            Route::get('detail/{id}', [ProductController::class, 'detail'])->name('detail');
            Route::post('detail/{id}', [ProductController::class, 'detailUpdate']);
            Route::get('detailDelete/{id}', [ProductController::class, 'detailDelete']);
            Route::get('edit/{id}', [ProductController::class, 'edit'])->name('productedit');
            Route::post('edit/{id}', [ProductController::class, 'update']);
            Route::get('delete/{id}', [ProductController::class, 'delete']);
        });
        //Thuộc tính của sản phẩm
        Route::prefix('attribute')->group(function () {
            Route::get('/', [AttributeController::class, 'index'])->name('attribute');
            Route::get('add', [AttributeController::class, 'create']);
            Route::post('add', [AttributeController::class, 'store']);
            Route::get('detail/{id}', [AttributeController::class, 'detail']);
            Route::post('detail/{id}', [AttributeController::class, 'detailUpdate']);
            Route::get('edit/{list}/{value}', [AttributeController::class, 'edit'])->name('attedit');
            Route::post('edit/{list}/{value}', [AttributeController::class, 'update']);
            Route::get('delete/{list}/{value}', [AttributeController::class, 'delete']);
        });
    });
    //Nhập Hàng
    Route::prefix('admin/import')->group(function (){
        Route::get('/', [ImportProductController::class, 'index'])->name('hoadonnhap');
        Route::get('add', [ImportProductController::class, 'add']);
        Route::post('add', [ImportProductController::class, 'store']);
        Route::any('save/{id}', [ImportProductController::class, 'save']);
        Route::get('detail/{hoadonnhap}', [ImportProductController::class, 'chitiet'])->name('importDetail');
    });
    //Tài khoản
    Route::prefix('admin/account')->group(function (){
        Route::get('/customer', [AccountController::class, 'customer'])->name('customer');

        Route::get('/supplier', [AccountController::class, 'supplier'])->name('supplier');
        Route::get('/supplierDetail/{id}', [AccountController::class, 'supplierDetail'])->name('supplier');
        Route::get('addSupplier', [AccountController::class, 'createSupplier']);
        Route::post('addSupplier', [AccountController::class, 'storeSupplier']);
        Route::get('editSupplier/{id}', [AccountController::class, 'editSupplier']);
        Route::post('editSupplier/{id}', [AccountController::class, 'updateSupplier']);
        Route::delete('deleteSupplier', [AccountController::class, 'deleteSupplier']);

        Route::get('/admin', [AccountController::class, 'admin'])->name('adminaccount');
        Route::get('add', [AccountController::class, 'add']);
        Route::post('add', [AccountController::class, 'store']);
        Route::get('edit/{id}', [AccountController::class, 'edit']);
        Route::post('edit/{id}', [AccountController::class, 'update']);

        Route::delete('delete', [AccountController::class, 'delete']);

    });
    //Hóa đơn
    Route::prefix('admin/order')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('order.dashboard');

        Route::get('/detail/{id}', [OrderController::class, 'show']);
        Route::get('/detailUpdate/{id}', [OrderController::class, 'detailUpdate']);
        Route::get('/detailUpdateCancel/{id}', [OrderController::class, 'detailUpdateCancel']);

        Route::get('/ship', [OrderController::class, 'ship'])->name('ship');
        Route::get('/shipUpdate/{id}', [OrderController::class, 'shipUpdate']);
        Route::get('/shipCancel/{id}', [OrderController::class, 'shipCancel']);

        Route::get('/bill', [OrderController::class, 'bill'])->name('bill');
        Route::get('/cancel', [OrderController::class, 'cancel'])->name('cancel');

    });

    #Slider
    Route::prefix('admin/sliders')->group(function () {
        Route::get('add', [SliderController::class, 'create']);
        Route::post('add', [SliderController::class, 'store']);
        Route::get('list', [SliderController::class, 'index'])->name('slider');
        Route::get('edit/{slider}', [SliderController::class, 'show']);
        Route::post('edit/{slider}', [SliderController::class, 'update']);
        Route::DELETE('destroy', [SliderController::class, 'destroy']);
    });
});


//Route Client
//Route::middleware('auth:web')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Products
    Route::get('/', [\App\Http\Controllers\Client\MainController::class, 'index'])->name('user.dashboard');
    Route::get('/shop', [\App\Http\Controllers\Client\MainController::class, 'shop']);
    Route::get('/c-{id}-{slug}', [\App\Http\Controllers\Client\MainController::class, 'category']);
    Route::get('/{id}-{slug}.html', [\App\Http\Controllers\Client\ProductController::class, 'index']);
    Route::post('/{id}-{slug}', [\App\Http\Controllers\Client\ProductController::class, 'reload'])->name('reload');
    Route::get('/search', [\App\Http\Controllers\Client\MainController::class, 'search']);
    Route::get('autocomplete-search', [\App\Http\Controllers\Client\MainController::class, 'autocompleteSearch']);
    Route::put('/search', [\App\Http\Controllers\Client\MainController::class, 'search_reload']);
//Carts
//Khi bấm nút "thêm vào giỏ hàng" bên trang chi tiết sản phẩm
    Route::post('/add-cart', [CartController::class, 'index'])->name('addcart');
    Route::post('/addcart', [CartController::class, 'hehe']);

    Route::post('/check', [CartController::class, 'check'])->name('check');
//Trang hiển thị giỏ hàng
    Route::get('/carts', [CartController::class, 'show']);
//Load lại trang hiển thị giỏ hàng
    Route::post('carts', [CartController::class, 'update'])->name('updatecart');

//Xóa các sản phẩm trong giỏ hàng
    Route::get('carts/delete/{id}', [CartController::class, 'remove']);
// Thêm route đơn hàng
    Route::get('order', [CartController::class, 'order'])->name('order');

//Thanh toán
    Route::get('checkout', [CartController::class, 'checkout'])->name('checkout');
//Lưu giỏ hàng
    Route::post('checkout', [CartController::class, 'addCart']);
    Route::post('/momo_payment', [CartController::class, 'momo_payment'])->name('checkout.momo_payment');
    Route::get('/contact', [\App\Http\Controllers\Client\ContactController::class, 'index'])->name('contact');
    Route::get('/about', [\App\Http\Controllers\AboutController::class, 'index'])->name('about');

    Route::get('/user-information', [UserController::class, 'index'])->name('user.information');
    Route::get('/change-password', [UserController::class, 'get_changePassword'])->name('user.change-password');
    Route::post('/change-password', [UserController::class, 'changePassword']);
    Route::post('/change-information', [UserController::class, 'changeInformation'])->name('user.information.change-information');
    Route::get('/login', [AuthUserController::class, 'login'])->name('loginUser');
    Route::post('/login', [AuthUserController::class, 'post_login']);
    Route::get('/register', [AuthUserController::class, 'register'])->name('registerUser');
    Route::post('/register', [AuthUserController::class, 'post_register']);
    Route::get('/logout', [AuthUserController::class, 'logout'])->name('logoutUser');
    Route::get('/forgot-password', [AuthUserController::class, 'forgot_password'])->name('forgot-user-password');
    Route::post('/forgot-password', [AuthUserController::class, 'post_forgot_password']);
    Route::get('/reset-user-password', [AuthUserController::class, 'reset_password'])->name('reset-user-password');
    Route::post('/reset-user-password', [AuthUserController::class, 'post_reset_password']);
//});
