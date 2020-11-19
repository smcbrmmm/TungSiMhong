<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\PaymentInfoContoller;
use App\Http\Controllers\ShipmentInfoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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
    return redirect('/home');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

Route::resource('/home' , HomeController::class);
Route::get('/report',[HomeController::class,'report'])->name('home.report');

Route::get('/payment/create/{id}',[PaymentInfoContoller::class,'createPayment'])->name('payment.createPayment');
Route::post('/payment/submit/{id}',[PaymentInfoContoller::class,'submitPayment'])->name('payment.submitPayment');
Route::put('/payment/unaccept/{id}',[PaymentInfoContoller::class , 'unAcceptPayment'])->name('payment.unAcceptPayment');

Route::put('/order/submit/{id}', [OrderController::class, 'submitOrder'])->name('order.submit');
Route::get('/order/show/basket', [OrderController::class, 'showBasket'])->name('order.basket');
Route::get('/order/admin', [OrderController::class, 'adminOrder'])->name('order.adminOrder');
Route::get('/order/basket', [OrderController::class, 'basketQty'])->name('order.basketQty');
Route::resource('/order' , OrderController::class);

Route::get('/product/{id}', [ProductController::class, 'getProduct'])->name('product.get');
Route::resource('/product', ProductController::class);
Route::get('/productCreate', [ ProductController::class,'productCreate'])->name('product.productCreate');

Route::put('/order_detail/{id}', [OrderDetailController::class, 'setQtyDetail'])->name('order-detail.setQty');
Route::resource('/order-detail', OrderDetailController::class);

Route::resource('/address', AddressController::class);

Route::resource('/order_detail', OrderDetailController::class);

Route::resource('/user', UserController::class);

Route::resource('/payment', PaymentInfoContoller::class);

Route::resource('/shipment', ShipmentInfoController::class);



