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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\ShopController::class, 'index'])->name('index');
Route::get('/mycart',[App\Http\Controllers\ShopController::class, 'mycart'])->name('mycart')->middleware('auth');
Route::post('/mycart',[App\Http\Controllers\ShopController::class, 'addmycart']);
Route::post('/cartdelete',[App\Http\Controllers\ShopController::class, 'deletecart']);
Route::post('/checkout',[App\Http\Controllers\ShopController::class, 'checkout']);
