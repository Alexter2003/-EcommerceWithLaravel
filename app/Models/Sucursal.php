<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sucursal extends Model
{
    use HasFactory;

    protected $table = 'sucursal';
    protected $primaryKey = 'idSucursal';
    public $incrementing = true;

    protected $fillable = [
        'Nombre',
        'Direccion',
        'Ubicacion',
    ];

    public function inventarioProductos()
    {
        return $this->hasMany(InventarioProducto::class, 'idSucursal');
    }

    public function trasladosOrigen()
    {
        return $this->hasMany(Traslado::class, 'idSucursal_Origen');
    }

    public function trasladosDestino()
    {
        return $this->hasMany(Traslado::class, 'idSucursal_Destino');
    }
}
