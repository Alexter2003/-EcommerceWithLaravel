<?php

use App\Http\Controllers\ControllerHome;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

//Rutas con ProductoController
Route::controller(ProductoController::class)->group(function () {
    Route::get('/', 'mostrarCategoriasEnHome');
    Route::get('/crudProductos', 'crudProductos')->name('productos.crud');
    Route::get('/crearProducto', 'crearProductosView')->name('productos.crear');
    Route::post('/productos/crear', 'create')->name('productos.store');
    Route::get('/editarProducto/{id}', 'editarProductosView')->name('editarProducto');
    Route::put('/productos/{id}', 'update')->name('productos.update');
    Route::patch('/eliminarProducto/{id}', 'eliminarProducto')->name('producto.eliminar');
});