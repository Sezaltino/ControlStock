<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;

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
    return view('welcome');
});

Route::get('/produtos/stock', [ProdutoController::class, 'stock'])->name('produtos.stock');
Route::resource('produtos', ProdutoController::class);
Route::delete('/produtos/{id}/{stock}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');




