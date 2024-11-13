<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    //obtener todos los usuarios
    public function obtenerUsuarios()
    {
        $usuarios = Usuario::all();
        return view('usuariosCrud', ['usuarios' => $usuarios]);
    }

    //retornar vista para el crud de usuarios
    public function editarUsuarioView($id)
    {
        $usuario = Usuario::findOrFail($id);
        $roles = Rol::all();
        $usuarioRolId = $usuario->roles->first()->idRol ?? null;

        return view('editarUsuario', [
            'usuario' => $usuario,
            'roles' => $roles,
            'usuarioRolId' => $usuarioRolId,
        ]);
    }

    //actualizar rol o nombre de usuario
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            // Validar datos
            $validatedData = $request->validate([
                'nombre' => 'required',
                'idRol' => 'required|numeric',
            ]);

            // Buscar el usuario
            $usuario = Usuario::findOrFail($id);

            // Actualizar el nombre del usuario
            $usuario->Usuario = $validatedData['nombre'];
            $usuario->save();

            // Actualizar el rol en la tabla intermedia
            $usuario->roles()->sync([$validatedData['idRol']]);

            DB::commit();

            return redirect()->route('usuarios.crud')->with('success', 'Usuario actualizado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error al actualizar el usuario: " . $e->getMessage());
            return response()->json(['error' => 'Error al actualizar el usuario', 'details' => $e->getMessage()], 500);
        }
    }

}
