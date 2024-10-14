<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    //Funcion que me dara todos los productos sin condiciones
    public function obtenerProductos()
    {
        return Producto::all();
    }

    //Funcion que me regresara la view de home, junto con un listado de categorias con sus productos para mostrar
    public function mostrarCategoriasEnHome()
    {
        $productos = $this->obtenerProductos();
        return view('home', ['productos' => $productos]);
    }

    public function crudProductos()
    {
        $productos = $this->obtenerProductos();
        return view('productosCrud', ['productos' => $productos]);
    }
}
