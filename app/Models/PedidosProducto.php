<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PedidosProducto extends Model
{
    use HasFactory;
    protected $table = 'pedidos_productos';
    protected $primaryKey = 'idPedidos_Productos';
    public $incrementing = true;
    protected $fillable = [
        'Cantidad',
        'idPedidos',
        'idProductos',
        'Total',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'idPedidos');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idProductos');
    }
}
