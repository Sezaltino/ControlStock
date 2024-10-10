<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return redirect('/produtos');
});

Route::get('/produtos/stock', [ProdutoController::class, 'stock'])->name('produtos.stock.index')->middleware('auth');
Route::resource('produtos', ProdutoController::class)->middleware('auth');
Route::delete('/produtos/{id}/{stock}', [ProdutoController::class, 'destroy'])->name('produtos.stock.destroy')->middleware('auth');
Auth::routes();
