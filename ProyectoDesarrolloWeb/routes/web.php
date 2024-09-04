<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

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



