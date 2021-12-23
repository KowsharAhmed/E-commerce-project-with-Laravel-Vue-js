<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
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
    return view('frontend.index');
});


Route::prefix('admin')->middleware(['auth:sanctum', 'verified'])->group(function (){
    Route::get('/', function () {
        return view('admin.dashboard');
    });

    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::get('orders', [OrderController::class,'index'])->name('orders.index');
    Route::get('orders/change-status/{id}', [OrderController::class,'changeStatus'])->name('orders.change-status');
});







Route::get('/{path}', function () {
    return view('frontend.index');
})->where('path','.*');

// Route::get('/admin/categories', [CategoryController::class,'index'])->name('categories.index');
// Route::get('/admin/categories/create', [CategoryController::class,'create'])->name('categories.create');
// Route::post('/admin/categories/', [CategoryController::class,'store'])->name('categories.store');
// Route::get('/admin/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
// Route::put('/admin/categories/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
// Route::delete('/admin/categories/destroy/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');



// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
