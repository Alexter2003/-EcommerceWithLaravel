<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User; // Asegúrate de tener este modelo
use App\Models\Role; // Asegúrate de tener este modelo
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    public function register(Request $request)
    {
        // Validación de los datos
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'password' => 'required|confirmed|min:8', // Confirmación de la contraseña
        ]);

        // Si la validación falla
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Crear el usuario
        $user = User::create([
            'Usuario' => $request->name,
            'Password' => Hash::make($request->password),
        ]);

        // Asignar el rol "Cliente" por defecto
        $role = Role::where('Nombre', 'Cliente')->first(); // O puedes cambiarlo por 'Admin' si lo deseas
        $user->roles()->attach($role->idRol); // Asignamos el rol al usuario

        // Redirigir al login con mensaje de éxito
        return redirect()->route('/')->with('success', 'Usuario registrado exitosamente.');
    }

    public function rshowRegistrationForm()
    {
        return view('crearCuenta'); // Vista de registro
    }
}
