<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';
    protected $primaryKey = 'idPedidos';
    public $incrementing = true;
    protected $fillable = [
        'FechaPedido',
        'idClientes',
        'idEstadoPago',
        'idEstadoPedido',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'idClientes');
    }

    public function productos()
    {
        return $this->hasMany(PedidosProducto::class, 'idPedidos');
    }
}
