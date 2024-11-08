<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';
    protected $primaryKey = 'idCategorias';
    public $incrementing = true;

    protected $fillable = [
        'Nombre',
        'Descripcion'
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'idCategorias');
    }
}
