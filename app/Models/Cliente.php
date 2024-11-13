<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $primaryKey = 'idClientes';
    public $incrementing = true;

    protected $fillable = [
        'Nombres',
        'Apellidos',
        'Telefono',
        'Correo',
        'Direccion',
        'Nit',
        'idUsuario', // Relación con el usuario
        'Departamento',
        'Municipio',
    ];

    public function user()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'idClientes');
    }
}
