<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WalletController;
use App\Http\Middleware\Customer;
use App\Http\Middleware\Admin;

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

Route::get('/', function () {
    return view('Auth/Login');
});

Route::post('/login', [LoginController::class,'authenticate'])->name('login');
Route::post('/logout', [LoginController::class,'logout'])->name('logout');
Route::get('/register', [CustomersController::class,'registerForm'])->name('registerForm');
Route::post('/register', [CustomersController::class,'store'])->name('createCustomer');


// Route::middleware([Customer::class])->group(function () {
   
//     Route::get('/shopNow', function () {
    
//         return view('customers/shopNow');
//     });
    
// });
Route::group(['middleware' => ['auth', 'customer']], function() {
    Route::get('/shopNow', function () {
        return view('customers/shopNow');
    });
    Route::get('/shop', [OrdersController::class,'shop'])->name('shop');
    Route::get('/buy-now/{id}', [OrdersController::class,'buyNow'])->name('buyNow');
    Route::post('/buy-now', [OrdersController::class,'customerOrder'])->name('customerOrder');
    Route::post('/orders/cancel', [OrdersController::class,'cancelOrder'])->name('cancelOrder');


    Route::get('/wallet', [WalletController::class,'myWallet'])->name('myWallet');
    Route::get('/wallet-recharge', [WalletController::class,'wRecharge'])->name('wRecharge');
    Route::post('/wallet-recharge', [WalletController::class,'recharge'])->name('recharge');

    Route::get('/withdrawal', [WalletController::class,'withdrawalForm'])->name('withdrawalForm');
    Route::post('/withdrawal', [WalletController::class,'withdrawal'])->name('withdrawal');

    Route::get('/myProfile/{id}', [CustomersController::class,'show'])->name('myProfile');

});

Route::group(['middleware' => ['auth', 'adminOrCustomer']], function() {
    Route::resource('orders', OrdersController::class);
    Route::post('/orders/update', [OrdersController::class,'updates'])->name('ordersUpdate');
    Route::post('/customers/update', [CustomersController::class,'updates'])->name('customerUpdate');
});

Route::group(['middleware' => ['auth', 'admin']], function() {
    Route::resource('products', ProductsController::class);
    Route::post('/products/update', [ProductsController::class,'updates'])->name('productUpdate');
    Route::post('/products/delete', [ProductsController::class,'destroy'])->name('productdestroy');

    Route::resource('customers', CustomersController::class);
    
    Route::post('/customers/delete', [CustomersController::class,'destroy'])->name('customerdestroy');
    Route::post('/orders/remove', [OrdersController::class,'remove'])->name('ordersdestroy');
});
