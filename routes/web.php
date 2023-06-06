<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LojaController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\CompradorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendedorController;
use App\Http\Middleware\CompradorMiddleware;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [LojaController::class, 'index'])->name('loja.home');

Route::get('/vendedor/confirma', [LojaController::class, 'verificaEmail'])->name('vendedor.email');
Route::get('/vendedor/produtos', [VendedorController::class, 'meusProdutos'])->name('vendedor.produtos');
Route::get('/vendedor/cadastroProduto', [VendedorController::class, 'cadastroIndex'])->name('vendedor.cadastro');
Route::post('/vendedor/saveProduto', [VendedorController::class, 'produtoStore'])->name('vendedor.store');


Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware('admin');
Route::get('/admin/compradores', [AdminController::class, 'compradores'])->name('admin.compradores')->middleware('admin');
Route::get('/admin/produtos', [AdminController::class, 'produtos'])->name('admin.produtos')->middleware('admin');
Route::get('/admin/vendedores', [AdminController::class, 'vendedores'])->name('admin.vendedores')->middleware('admin');
Route::put('/admin/vendedores/update/{vendedor}', [AdminController::class, 'updateStatus'])->name('updateStatus')->middleware('admin');

Route::get('/produto/{id}', [ProdutosController::class, 'verProduto'])->name('produto.ver');
Route::get('/produto/checkout/{id}', [ProdutosController::class, 'checkout'])->name('produto.checkout')->middleware('comprador');
Route::get('/produto/editar/{id}', [ProdutosController::class, 'editar'])->name('produto.editar');
Route::put('/produto/update', [ProdutosController::class, 'update'])->name('produto.update');

Route::get('/comprador/edit', [CompradorController::class, 'editComprador'])->name('edit.comprador');
Route::put('/comprador/update', [CompradorController::class, 'updateComprador'])->name('comprador.update');
Route::get('/comprador/compras', [CompradorController::class, 'mostrarCompras'])->name('compras');

Route::post('/checkout', [LojaController::class, 'checkout'])->name('checkout');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
