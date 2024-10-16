<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function obtenerMarcas()
    {
        return Marca::all();
    }
}
