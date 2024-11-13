<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Usuario;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    // Mostrar formulario de registro
    public function formularioRegistro()
    {
        return view('crearCuenta');
    }

    // Manejar el registro de un usuario
    public function registrar(Request $request)
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

            // Asignar el rol "Cliente", todos los usuarios por defecto se crearan con este rol
            $role = Rol::where('Nombre', 'Cliente')->first();

            if ($role) {
                $user->roles()->attach($role->idRol);
            } else {
                throw new \Exception("El rol 'Cliente' no existe.");
            }

            DB::commit();


            return redirect()->route('login')->with('success', 'Usuario registrado con éxito.');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error al registrar el usuario: " . $e->getMessage());

            return redirect()->back()->with('error', 'Hubo un error al registrar el usuario. Por favor, intente de nuevo.');
        }
    }

    // Mostrar formulario de inicio de sesion
    public function formularioLogin()
    {
        return view('login');
    }

    // Manejar el inicio de sesion del usuario
    public function login(Request $request)
    {
        $request->validate([
            'Usuario' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        DB::beginTransaction();

        try {
            $credentials = $request->only('Usuario', 'password');

            if (Auth::attempt(['Usuario' => $credentials['Usuario'], 'password' => $credentials['password']])) {
                $request->session()->regenerate();
                DB::commit();
                return redirect()->intended('/')->with('success', 'Bienvenido(a) ' . Auth::user()->Usuario);
            } else {
                $user = Usuario::where('Usuario', $credentials['Usuario'])->first();
                if ($user && !Hash::check($credentials['password'], $user->Password)) {
                    // Contraseña incorrecta pero el usuario existe
                    return back()->withErrors(['password' => 'La contraseña es incorrecta.']);
                }

                throw new \Exception("Las credenciales no coinciden con nuestros registros.");
            }
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error al intentar iniciar sesión: " . $e->getMessage());

            return back()->withErrors([
                'Usuario' => $e->getMessage(),
            ]);
        }
    }

    // Cerrar sesion
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
