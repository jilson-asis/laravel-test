<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/home', [HomeController::class, 'index'])->name('index');

Route::get('/checkout/success', [PurchaseController::class, 'success'])->name('purchase.success');
//Route::get('/checkout/cancel', [PurchaseController::class, 'cancel'])->name('purchase.cancel');
Route::get('/checkout/{product}', [PurchaseController::class, 'checkout'])->name('purchase.checkout');
Route::post('/checkout/purchase/{product}', [PurchaseController::class, 'purchase'])->name('purchase.purchase');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/users/cancel/{user}', [UserController::class, 'cancel'])->name('users.cancel');
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('purchases', PurchaseController::class);
});
