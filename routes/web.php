<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VentaController;
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

Route::get('/', [ProductoController::class, 'index'])->middleware(['auth', 'verified']);


Route::get("/searchProduct", [ProductoController::class, 'searchProduct']);

// Route::get('/', function () {
//     return view('cliente.welcome');
// })->middleware(['auth', 'verified']);

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
//Route::resource('/producto', ProductoController::class)->middleware("auth");

//Rutas de cliente
Route::get('/producto/{idProd}', [ProductoController::class, 'show'])->name('producto_show');
Route::get('/carrito', [VentaController::class, 'cart'])->name('carrito');

//Rutas de administrativos
Route::middleware('auth')->group(function () {
    Route::view('/usuarios', 'administrador.usuarios.index')->name('administrador_usuarios');
    Route::view('/productos', 'administrador.productos.index')->name('administrador_productos');
    Route::view('/ventas', 'administrador.ventas.index')->name('administrador_ventas');
    Route::view('/ofertas', 'administrador.ofertas.index')->name('administrador_ofertas');
    Route::view('/ofertas/crear', 'administrador.ofertas.create')->name('crear_oferta');
    Route::view('/reportes', 'administrador.reportes.index')->name('administrador_reportes');
});

Route::view('/perfilCliente', 'cliente.usuario.index')->name('cliente_show');

Route::view('/detalleCompra', 'cliente.ventas.show')->name('cliente_show_venta');

Route::view('/crearUsuario', 'administrador.usuarios.create')->name('administrador_create_usuario');

Route::view('/crearProducto', 'administrador.productos.create')->name('administrador_create_producto');

require __DIR__ . '/auth.php';
