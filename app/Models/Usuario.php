<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'idUsuario';
    public $timestamps = false;

    protected $fillable = [
        'Usuario',
        'Password',
    ];

    protected $hidden = [
        'Password',
    ];

    // Para definir la relación con roles
    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'rols_usuarios', 'idUsuario', 'idRol');
    }

    // Método para verificar si el usuario tiene un rol específico
    public function hasRole($roleName)
    {
        return $this->roles->contains('Nombre', $roleName);
    }
}
