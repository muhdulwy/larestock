<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\StockController;
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

Route::get('/', function(){
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('barang', BarangController::class);
    Route::get('getBarang', [BarangController::class, 'getBarang'])->name('data.barang');
    Route::resource('stock', StockController::class);
    Route::get('getStock', [StockController::class, 'getStock'])->name('data.stock');
});
