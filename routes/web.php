<?php

use App\Http\Controllers\OfertaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\UsuarioController;
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

Route::get('/', [ProductoController::class, 'index'])->name('home');
Route::get("/search", [ProductoController::class, 'search']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Route::view('/perfilCliente', 'cliente.usuario.index')->name('cliente_show');
    Route::get('/perfilCliente', [UsuarioController::class, 'show'])->name('cliente_show');
    Route::post('/perfilCliente/cambioContrasenia', [UsuarioController::class, 'update_psw'])->name('cliente_cambio_contrasenia');
    Route::patch('/perfilCliente/cambiosPerfil', [UsuarioController::class, 'update'])->name('cliente_cambio_perfil');
});

//Rutas para ver productos y combos
Route::get('/producto/{idProd}', [ProductoController::class, 'show'])->name('producto_show');
Route::get('/combo/{idCombo}', [OfertaController::class, 'show'])->name('combo_show');

//Rutas del carrito
Route::get('/carrito', [VentaController::class, 'cart'])->name('carrito');
Route::post('/carrito/{tipoItem}/{id}', [VentaController::class, 'updateCart'])->name('carrito_agregar')->middleware('web');
Route::patch('/carrito/{tipoItem}/{id}', [VentaController::class, 'editCart'])->name('carrito_editar');
Route::delete('/carrito/{tipoItem}/{id}', [VentaController::class, 'removeFromCart'])->name('carrito_eliminar')->middleware('web');

//Rutas de ventas para cliente
Route::post('/venta/registrar/{idCliente}', [VentaController::class, 'store'])->name('registrar_venta');

//Rutas de administrativos
Route::middleware('auth')->group(function () {
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('administrador_usuarios');

    Route::view('/productos', 'administrador.productos.index')->name('administrador_productos');

    Route::get('/ventas', [VentaController::class, 'index'])->name('administrador_ventas');

    Route::view('/ofertas', 'administrador.ofertas.index')->name('administrador_ofertas');
    Route::get('/ofertas/crear', [OfertaController::class, 'create'])->name('crear_oferta');
    Route::post('/ofertas/guardar', [OfertaController::class, 'store'])->name('guardar_oferta');
    
    Route::view('/reportes', 'administrador.reportes.index')->name('administrador_reportes');
});

Route::get('/detalleVenta/{idVenta}', [VentaController::class, 'show'])->name('cliente_show_venta'); 

//Route::view('/detalleCompra/{idVenta}','cliente.ventas.show')->name('cliente_show_venta');

Route::view('/crearUsuario', 'administrador.usuarios.create')->name('administrador_create_usuario');

Route::view('/crearProducto', 'administrador.productos.create')->name('administrador_create_producto');
Route::view('/editarProducto', 'administrador.productos.edit')->name('administrador_edit_producto');

//Rutas reportes
Route::post("/reporteRedirect", [ReporteController::class, "ReporteRedirect"])->name("reporteRedirect");


require __DIR__ . '/auth.php';
