<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductosfinalesController;
use App\Http\Controllers\ProductosterminadosController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\BancoController;




// Rutas de autenticación estándar proporcionadas por Laravel
Auth::routes();

// Rutas personalizadas para el inicio de sesión y registro
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Rutas para productos
Route::get('/', [ProductosController::class, 'index'])->name('productos.index');
Route::get('/create', [ProductosController::class, 'create'])->name('productos.create');
Route::post('/store', [ProductosController::class, 'store'])->name('productos.store');
Route::get('/edit/{id}', [ProductosController::class, 'edit'])->name('productos.edit');
Route::put('/update/{id}', [ProductosController::class, 'update'])->name('productos.update');
Route::get('/show/{id}', [ProductosController::class, 'show'])->name('productos.show');
Route::delete('/destroy/{id}', [ProductosController::class, 'destroy'])->name('productos.destroy');

// Ruta adicional para la página principal
Route::get('/home', [HomeController::class, 'index'])->name('home');


// ruta para la vista de registros de movimientos
Route::get('/registro', [ProductosController::class, 'mostrarRegistro'])->name('registro');

//rutas para la vista de produccion
Route::post('/producir', [ProductosController::class, 'producir'])->name('producir');
Route::get('/produccion', [ProductosController::class, 'mostrarProduccion'])->name('produccion');

//Rutas producto terminado
Route::get('/productoterminado', [ProductosfinalesController::class, 'productoterminado'])->name('productot');
Route::get('/actualizarproducto/{id}', [ProductosfinalesController::class, 'edit'])->name('actualizarp');
Route::get('/showproducto/{id}', [ProductosfinalesController::class, 'show'])->name('showp');
Route::put('/updatep/{id}', [ProductosfinalesController::class, 'update'])->name('updatep');
Route::get('/eliminarUltimoProducto', [ProductosfinalesController::class, 'eliminarUltimoProducto'])->name('eliminarUltimoProducto');

Route::get('/agregarproducto', [ProductosfinalesController::class, 'create'])->name('agregarp');
Route::post('/storeproducto', [ProductosfinalesController::class, 'store'])->name('storep');
Route::delete('/destroyp/{id}', [ProductosfinalesController::class, 'destroy'])->name('destroyp');

// Ruta para mostrar la selección de clientes
Route::get('/venta', [VentaController::class, 'mostrarCliente'])->name('ventacliente');

// Ruta para mostrar productos después de seleccionar un cliente
Route::post('/productos', [VentaController::class, 'mostrarProductos'])->name('ventaproducto');

// Ruta para obtener el stock de un producto final
Route::get('/obtener-stock/{productoId}', [ProductosfinalesController::class, 'obtenerStock'])->name('obtener.stock');

// Ruta para guardar la venta
Route::post('/guardar-venta', [VentaController::class, 'guardarVenta'])->name('guardar.venta');

Route::get('/ventas', [VentaController::class, 'index'])->name('indexpdf');
Route::get('/ventas/{id}/pdf', [VentaController::class, 'generarPDF'])->name('pdf');


Route::get('inicioclientes', [ClientesController::class,'index'])->name('inicioclientes');
Route::get('/clientes', [ClientesController::class,'create'])->name('clientes.create');
Route::get('/clientes/buscar', [ClientesController::class, 'buscar'])->name('clientes.buscar');
Route::get('/clientes/{id}/show', [ClientesController::class, 'show'])->name('clientes.show');
Route::post('/clientes', [ClientesController::class, 'store'])->name('clientes.store');
Route::delete('/clientes/{id}', [ClientesController::class, 'destroy'])->name('clientes.destroy');
Route::get('/clientes/{id}/edit', [ClientesController::class, 'edit'])->name('clientes.edit'); // Solo una ruta edit
Route::put('/clientes/{id}', [ClientesController::class, 'update'])->name('clientes.update');

//ruta para historial de ventas
Route::get('/historial', [VentaController::class, 'mostrarHistorialVentas'])->name('ventas.historial');
Route::get('/ventas/buscar', [VentaController::class, 'buscarVentas'])->name('ventas.buscar');

//Ruta para bancos
Route::get('/bancos', [BancoController::class, 'index'])->name('bancos');

