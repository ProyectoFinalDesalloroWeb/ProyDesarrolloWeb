<?php

use App\Http\Controllers\ProductosController;
use Illuminate\Support\Facades\Route;

Route::get('/',[ProductosController::class, 'index'])->name('productos.index');
Route::get('/edit',[ProductosController::class, 'edit'])->name('productos.edit');

//mostrar el formulario para ingresar materia prima
route::get('/create',[ProductosController::class, 'create'])->name('productos.create');
//para ingresar los datos
route::post('/store',[ProductosController::class, 'store'])->name('productos.store');