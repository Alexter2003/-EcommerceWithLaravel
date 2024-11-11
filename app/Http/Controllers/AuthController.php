<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Usuario;
use App\Models\Role;  // Agregamos el modelo Role
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    // Mostrar formulario de registro
    public function showRegisterForm()
    {
        return view('crearCuenta');
    }

    // Manejar el registro de un usuario
    public function register(Request $request)
    {

        $request->validate([
            'Usuario' => 'required|unique:usuarios,Usuario',
            'password' => 'required|min:6|confirmed',
        ]);

        DB::beginTransaction();

        try {
            // Crear el usuario
            $user = new Usuario();
            $user->Usuario = $request->Usuario;
            $user->Password = Hash::make($request->password);
            $user->save();

            // Asignar el rol "Cliente"
            $role = Rol::where('Nombre', 'Cliente')->first();

            if ($role) {
                $user->roles()->attach($role->idRol);
            } else {
                throw new \Exception("El rol 'Cliente' no existe.");
            }

            DB::commit();


            return redirect()->route('register')->with('success', 'Usuario registrado con éxito.');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error al registrar el usuario: " . $e->getMessage());

            return redirect()->back()->with('error', 'Hubo un error al registrar el usuario. Por favor, intente de nuevo.');
        }
    }

    // Mostrar formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Manejar el inicio de sesión del usuario
    public function login(Request $request)
    {
        $credentials = $request->only('Usuario', 'Password');

        if (Auth::attempt(['Usuario' => $credentials['Usuario'], 'password' => $credentials['Password']])) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'Usuario' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
