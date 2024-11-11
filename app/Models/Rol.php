<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'rols';
    protected $primaryKey = 'idRol';
    public $timestamps = false;

    protected $fillable = [
        'Nombre',
        'Descripcion',
    ];

    // Relación con usuarios
    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'rols_usuarios', 'idRol', 'idUsuario');
    }
}
