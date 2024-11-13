<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventarioProducto extends Model
{
    protected $table = 'inventario_productos';
    protected $primaryKey = 'idInventarios_Productos';
    public $incrementing = true;

    protected $fillable = [
        'idSucursal',
        'idProductos',
        'Cantidad',
        'FechaCompra',
        'Lote',
    ];


    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'idSucursal');
    }

    public function productos()
    {
        return $this->belongsTo(Producto::class, 'idProductos');
    }

}
