<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UserController;


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


Route::get('/produtos/stock', [ProdutoController::class, 'stock'])
    ->name('produtos.stock.index')
    ->middleware('auth');

Route::resource('produtos', ProdutoController::class)
    ->middleware('auth');

Route::delete('/produtos/{id}/{stock}', [ProdutoController::class, 'destroy'])
    ->name('produtos.stock.destroy')
    ->middleware('auth');

Route::get('/users', [UserController::class, 'index'])
    ->name('users.index')
    ->middleware('auth');

Route::delete('/users/{id}', [UserController::class, 'destroy'])
    ->name('users.destroy')
    ->middleware('auth');

Route::resource('users', UserController::class)
    ->middleware('auth');

Route::get('/produtos/{id}/add-to-stock', [ProdutoController::class, 'addToStock'])->name('produtos.add.to.stock');


Auth::routes();
