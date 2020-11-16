<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
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
    redirect('/home');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

Route::resource('/home' , HomeController::class);

Route::resource('/order' , OrderController::class);
Route::get('/order/basket', [OrderController::class, 'basketQty'])->name('order.basketQty');

Route::resource('/product', ProductController::class);

Route::resource('/order-detail', OrderDetailController::class);

Route::resource('/address', AddressController::class);

Route::resource('/order_detail', OrderDetailController::class);

Route::resource('/user', UserController::class);


