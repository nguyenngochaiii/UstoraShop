<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminOrderController;

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
    return view('index');
});

Route::resource('products', ProductController::class);
Route::resource('cart', CartController::class);
Route::resource('checkout',CheckoutController::class);
Route::get('/my-cart',[OrderController::class, 'index'])->name('orders.index');
Route::post('/orders',[OrderController::class, 'store'])->name('orders.store');
Route::put('/orders/update',[OrderController::class, 'update'])->name('orders.update');
Route::delete('/orders/{order}/',[OrderController::class, 'destroy'])->name('orders.destroy');

Route::middleware(['auth','isAdmin'])->group(function ()
{
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/',[AdminController::class, 'index'])->name('index');
        Route::get('/products/create',[AdminProductController::class, 'create'])->name('products.create');
        Route::get('/products/index',[AdminProductController::class, 'index'])->name('products.index');
        Route::post('/products/',[AdminProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit',[AdminProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}/',[AdminProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}/',[AdminProductController::class, 'destroy'])->name('products.destroy');
    
        Route::get('/users/index',[AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/create',[AdminUserController::class, 'create'])->name('users.create');
        Route::post('/users/',[AdminUserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit',[AdminUserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}/',[AdminUserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}/',[AdminUserController::class, 'destroy'])->name('users.destroy');
    
        Route::get('/orders/index',[AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/create',[AdminOrderController::class, 'create'])->name('orders.create');
        Route::post('/orders/',[AdminOrderController::class, 'store'])->name('orders.store');
        Route::get('/orders/{order}/edit',[AdminOrderController::class, 'edit'])->name('orders.edit');
        Route::put('/orders/{order}/',[AdminOrderController::class, 'update'])->name('orders.update');
        Route::delete('/orders/{order}/',[AdminOrderController::class, 'destroy'])->name('orders.destroy');
    });
});
    

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';