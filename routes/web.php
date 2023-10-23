<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('cliente.welcome');
})->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// TEST ROUTES 

//Route::get("/productos", [ProductoController::class, "index"])->name("productos.index");

Route::resource('/producto', ProductoController::class)->middleware("auth");

Route::view('/perfil','cliente.usuario.index')->name('show.cliente');

Route::view('/detalleCompra','cliente.ventas.show')->name('show.venta');

Route::view('/administrador_create_usuario', 'administrador.usuarios.create')->name('administrador_create_usuario');

require __DIR__ . '/auth.php';
