<?php

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/', [\App\Http\Controllers\PagesController::class, 'index'])->name('index');
Route::get('index', [\App\Http\Controllers\PagesController::class, 'index'])->name('index');
Route::get('login', [\App\Http\Controllers\PagesController::class, 'login'])->name('login');
Route::get('register', [\App\Http\Controllers\PagesController::class, 'register'])->name('register');
Route::get('search', [\App\Http\Controllers\PagesController::class, 'search'])->name('search');
Route::get('cart', [\App\Http\Controllers\PagesController::class, 'cart'])->name('cart');
Route::get('store', [\App\Http\Controllers\PagesController::class, 'store'])->name('store');
Route::get('sellercenter', [\App\Http\Controllers\PagesController::class, 'sellercenter'])->name('sellercenter');
Route::get('productDetail', [\App\Http\Controllers\PagesController::class, 'productDetail'])->name('productDetail');
Route::get('dindan', [\App\Http\Controllers\PagesController::class, 'dindan'])->name('dindan');
Route::get('category', [\App\Http\Controllers\PagesController::class, 'category'])->name('category');
Route::get('accountadjust', [\App\Http\Controllers\PagesController::class, 'accountadjust'])->name('accountadjust');
Route::get('administrator', [\App\Http\Controllers\PagesController::class, 'administrator'])->name('administrator');
