<?php

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ControllerHome;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

//Rutas con ProductoController
Route::controller(ProductoController::class)->group(function () {
    //vista home
    Route::get('/', 'mostrarCategoriasEnHome');
    //Tabla de productos
    Route::get('/crudProductos', 'crudProductos')->name('productos.crud');
    //Vista para crear productos
    Route::get('/crearProducto', 'crearProductosView')->name('productos.crear');
    //Crear productos
    Route::post('/productos/crear', 'create')->name('productos.store');
    //Vista para editar producto
    Route::get('/editarProducto/{id}', 'editarProductosView')->name('editarProducto');
    //Editar producto
    Route::put('/productos/editar/{id}', 'update')->name('productos.update');
    //Desactivar producto
    Route::patch('/eliminarProducto/{id}', 'eliminarProducto')->name('producto.eliminar');
});

Route::controller(MarcaController::class)->group(function () {
    //Tabla de marcas
    Route::get('/crudMarcas', 'obtenerMarcas')->name('marcas.crud');
    //Vista para crear marca
    Route::get('/crearMarca', 'crearMarcasView')->name('marcas.crear');
    //Crear Marca
    Route::post('/marcas/crear', 'create')->name('marcas.store');
    //Vista para editar marca
    Route::get('/editarMarca/{id}', 'editarMarcaView')->name('editarMarca');
    //Editar marca
    Route::put('/marca/editar/{id}', 'update')->name('marcas.update');
    //Desactivar marca
    Route::patch('/eliminarMarca/{id}', 'eliminarMarca')->name('marcas.eliminar');
});

Route::controller(CategoriasController::class)->group(function () {
    //Tabla de categorias
    Route::get('/crudCategorias', 'obtenerCategorias')->name('categorias.crud');
    //Vista para crear categoria
    Route::get('/crearCategoria', 'crearCategoriasView')->name('categorias.crear');
    //Crear categorias
    Route::post('/categorias/crear', 'create')->name('categorias.store');
    //Vista para editar categoria
    Route::get('/editarCategoria/{id}', 'editarCategoriaView')->name('editarCategoria');
    //Editar categoria
    Route::put('categoria/editar/{id}', 'update')->name('categorias.update');
});

