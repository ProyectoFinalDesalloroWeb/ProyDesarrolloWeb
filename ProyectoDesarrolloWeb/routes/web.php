<?php

use App\Http\Controllers\ProductosController;
use Illuminate\Support\Facades\Route;

Route::get('/',[ProductosController::class, 'index'])->name('productos.idex');
Route::get('/create',[ProductosController::class, 'create'])->name('productos.create');
Route::get('/edit',[ProductosController::class, 'edit'])->name('productos.edit');