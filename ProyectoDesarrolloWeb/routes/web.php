<?php

use App\Http\Controllers\ProductosController;
use Illuminate\Support\Facades\Route;

Route::get('/',[ProductosController::class, 'index'])->name('productos.index');
Route::get('/edit/{id}',[ProductosController::class, 'edit'])->name('productos.edit');

//mostrar el formulario para ingresar materia prima
route::get('/create',[ProductosController::class, 'create'])->name('productos.create');
//para ingresar los datos
route::post('/store',[ProductosController::class, 'store'])->name('productos.store');

//mostrar lo que va a editar
Route::get('/edit/{id}',[ProductosController::class, 'edit'])->name('productos.edit');
//para actualizar los datos
route::put('/update/{id}',[ProductosController::class, 'update'])->name('productos.update');

//mostar lo que va eliminar
route::get('/show/{id}',[ProductosController::class, 'show'])->name('productos.show');
//eliminar datos
route::delete('/destroy/{id}',[ProductosController::class, 'destroy'])->name('productos.destroy');