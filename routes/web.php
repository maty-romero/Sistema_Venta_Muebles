<?php

use App\Http\Controllers\OfertaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Stmt\Return_;


Route::get('/', [ProductoController::class, 'index'])->name('home');
//PRODUCTOS CLIENTE
Route::get("/search", [ProductoController::class, 'search']);
// BUSQUEDAS ADMIN
Route::get("/searchProducto", [ProductoController::class, 'searchProducto']);
Route::get("/searchUser", [UsuarioController::class, 'searchUser']);
Route::get("/searchVenta", [VentaController::class, 'searchVenta']);

Route::view('/registrar/cliente', 'cliente.registro')->name('cliente_create');
Route::post('/registrar/cliente/guardar', [UsuarioController::class, 'store'])->name('cliente_store');
Route::view('/usuario/login', 'cliente.login')->name('cliente_login'); 

Route::middleware('soloCliente')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/perfilCliente', [UsuarioController::class, 'show'])->name('cliente_show');
    Route::post('/perfilCliente/cambioContrasenia', [UsuarioController::class, 'update_psw'])->name('cliente_cambio_contrasenia');
    Route::patch('/perfilCliente/cambiosPerfil', [UsuarioController::class, 'update'])->name('cliente_cambio_perfil');
    
    //Rutas de ventas para cliente  
    Route::get('/detalleVenta/{idVenta}', [VentaController::class, 'show'])->name('cliente_show_venta');
    Route::post('/venta/registrar/{idCliente}', [VentaController::class, 'store'])->name('registrar_venta');
});

//Rutas del carrito
Route::get('/carrito', [VentaController::class, 'cart'])->name('carrito');
Route::post('/carrito/{tipoItem}/{id}', [VentaController::class, 'updateCart'])->name('carrito_agregar')->middleware('web');
Route::patch('/carrito/{tipoItem}/{id}', [VentaController::class, 'editCart'])->name('carrito_editar');
Route::delete('/carrito/{tipoItem}/{id}', [VentaController::class, 'removeFromCart'])->name('carrito_eliminar')->middleware('web');


//Rutas para ver productos y combos
Route::get('/producto/{idProd}', [ProductoController::class, 'show'])->name('producto_show');
Route::get('/combo/{idCombo}', [OfertaController::class, 'show'])->name('combo_show');

//Rutas de administrativos
Route::middleware(['auth', 'soloAdm'])->group(function () {
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('administrador_usuarios');

    Route::get('/usuarios/crear', [UsuarioController::class, 'create'])->name('administrador_create_usuario');
    Route::post('/usuarios/guardar', [UsuarioController::class, 'store'])->name('administrador_store_usuario');
    Route::get('/usuarios/editar/{usuario}', [UsuarioController::class, 'edit'])->name('administrador_edit_usuarios');
    Route::patch('/usuarios/{idUsr}', [UsuarioController::class, 'update_user'])->name('administrador_update_usuarios');
    Route::delete('/usuarios/{usuario}', [UsuarioController::class, 'destroy'])->name('administrador_delete_usuarios');

    Route::get('/productos', [ProductoController::class, 'index_adm'])->name('administrador_productos');
    Route::get('/productos/crear', [ProductoController::class, 'create'])->name('administrador_create_producto');
    Route::post('/productos/guardar', [ProductoController::class, 'store'])->name('administrador_store_producto');

    Route::get('/productos/editar/{producto}', [ProductoController::class, 'edit'])->name('administrador_edit_producto'); //ACA
    Route::patch('/productos/cambioInfo/{idProducto}', [ProductoController::class, 'update'])->name('administrador_update_producto');

    Route::post('/productos/actualizarStock/{idProducto}', [ProductoController::class, 'update_stock_producto'])->name('producto_updateStock');
    Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('administrador_delete_producto');

    Route::get('/productos/{idProd}', [ProductoController::class, 'admShow'])->name('administrador_producto_show');
    
    Route::get('/ventas', [VentaController::class, 'index'])->name('administrador_ventas');

    Route::get('/ofertas', [OfertaController::class, 'index'])->name('administrador_ofertas');
    Route::get('/ofertas/crear', [OfertaController::class, 'create'])->name('crear_oferta');
    Route::post('/ofertas/guardar', [OfertaController::class, 'store'])->name('guardar_oferta');
    Route::get('/ofertas/editar/{oferta}', [OfertaController::class, 'edit'])->name('administrador_edit_ofertas');
    Route::patch('/ofertas/{ofertas}', [OfertaController::class, 'update'])->name('administrador_update_ofertas');

    //Rutas reportes
    Route::get('/reportes',  [ReporteController::class, "index"])->name('administrador_reportes');
    Route::get('/reportes/{id}',  [ReporteController::class, "index"])->name('administrador_reportes_cliente');
    Route::post("/reporteRedirect", [ReporteController::class, "ReporteRedirect"])->name("reporteRedirect");
});

require __DIR__ . '/auth.php';
