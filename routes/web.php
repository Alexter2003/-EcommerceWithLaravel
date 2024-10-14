<?php

use App\Http\Controllers\ControllerHome;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Rutas con ProductoController
//Home de la pagina
Route::get('/home', [ProductoController::class, 'mostrarCategoriasEnHome']);
Route::get('/crudProductos', [ProductoController::class, 'crudProductos']);


