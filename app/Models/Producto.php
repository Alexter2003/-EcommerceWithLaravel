<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;


    protected $table = 'productos';
    protected $primaryKey = 'idProductos';
    public $incrementing = true;

    protected $fillable = [
        'Nombre',
        'Descripcion',
        'idMarcas',
        'UrlProducto',
        'IdCategoria',
        'ultimoPrecioCompra',
        'ultimoPrecioVenta',
    ];


    // Relación: un producto pertenece a una marca
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'idMarcas');
    }

    // Relación: un producto puede tener muchas categorías a través de la tabla 'categorias_productos'
    public function categorias()
    {
        return $this->bbelongsTo(Categoria::class, 'idCategorias');
    }
}

