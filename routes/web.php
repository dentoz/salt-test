<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PrepaidController;
use App\Http\Controllers\ProductsController;
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


Route::get('/', [AuthController::class, 'showFormLogin'])->name('login');
Route::get('login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showFormRegister'])->name('register');
Route::post('register', [AuthController::class, 'register'])->middleware('auto_db_transaction');

Route::group(['middleware' => 'auth'], function () {

    Route::get('home', [PrepaidController::class, 'index'])->name('home');
    Route::get('prepaid', [PrepaidController::class, 'index'])->name('prepaid');
    Route::post('prepaid/process', [PrepaidController::class, 'process'])->middleware('auto_db_transaction');
    Route::get('prepaid/result/{prepaid}', [PrepaidController::class, 'result'])->name('prepaidResult');
    Route::get('prepaid/pay-order/{prepaid}', [PrepaidController::class, 'pay'])->name('payOrder');
    Route::get('products', [ProductsController::class, 'index'])->name('products');
    Route::post('products/process', [ProductsController::class, 'process'])->middleware('auto_db_transaction');
    Route::get('products/result/{products}', [ProductsController::class, 'result'])->name('productsResult');
    Route::get('order/pay-order/{order_id}', [OrdersController::class, 'index'])->name('order');
    Route::post('order/autocomplete', [OrdersController::class, 'autocomplete']);
    Route::post('order/get-order', [OrdersController::class, 'getOrder']);
    Route::post('order/process', [OrdersController::class, 'process'])->middleware('auto_db_transaction');
    Route::get('order/history', [OrdersController::class, 'history'])->name('history');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

});
