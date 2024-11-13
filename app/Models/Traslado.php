<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Traslado extends Model
{
    protected $table = 'traslados';
    protected $primaryKey = 'idTraslado';
    public $timestamps = false;

    protected $fillable = [
        'idProductos',
        'Fecha',
        'Estado',
        'Cantidad',
        'idSucursal_Origen',
        'idSucursal_Destino',
        'idUsuario'
    ];

}
