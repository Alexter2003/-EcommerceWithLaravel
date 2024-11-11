<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function assignRole(Request $request, $userId)
    {
        $user = Usuario::findOrFail($userId);
        $role = Rol::findOrFail($request->idRol);

        $user->roles()->attach($role);

        return redirect()->back()->with('success', 'Rol asignado correctamente.');
    }

    public function removeRole(Request $request, $userId)
    {
        $user = Usuario::findOrFail($userId);
        $role = Rol::findOrFail($request->idRol);

        $user->roles()->detach($role);

        return redirect()->back()->with('success', 'Rol removido correctamente.');
    }

    public function index()
    {
        $users = User::with('roles')->get();
        return view('roles.index', compact('users'));
    }

}
