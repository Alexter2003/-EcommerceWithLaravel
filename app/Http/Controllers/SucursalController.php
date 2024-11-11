<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SucursalController extends Controller
{
    //TABLA DE SUCRUSALES
    public function obtenerSucursales()
    {
        $sucursales = Sucursal::all();
        return view('sucursalesCrud', ['sucursales' => $sucursales]);
    }
    //VISTA PARA CREAR SUCURSAL
    public function crearSucursalView()
    {
        return view('crearSucursales');
    }
    //CREAR SUCURSALES NUEVAS
    public function create(Request $request)
    {
        DB::beginTransaction();

        try {
            // Validar datos
            $validatedData = $request->validate([
                'nombre' => 'required',
                'direccion' => 'required',
                'Ubicacion' => 'nullable'
            ]);

            // Crear el nueva sucursal
            $sucursal = new Sucursal();
            $sucursal->Nombre = $validatedData['nombre'];
            $sucursal->Direccion = $validatedData['direccion'];
            $sucursal->Ubicacion = $validatedData['Ubicacion'];
            $sucursal->save();

            DB::commit();

            return redirect()->route('sucursales.crud')->with('success', 'Sucursal creada exitosamente');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error al crear la categoria: " . $e->getMessage());
            return response()->json(['error' => 'Error al crear la categoria', 'details' => $e->getMessage()], 500);
        }
    }
    //VIEW PARA EDITAR SUCURSALES
    public function editarCategoriaView($id)
    {
        $sucurasl = Sucursal::findOrFail($id);
        return view('editarSucursal', ['sucurasl' => $sucurasl]);
    }

    //EDITAR SUCURSAL
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            // Validar datos
            $validatedData = $request->validate([
                'nombre' => 'required',
                'direccion' => 'required',
                'Ubicacion' => 'nullable',
                'estado' => 'required|numeric',
            ]);

            //BUSCAR EL PRODUCTO
            $sucursal = Sucursal::findOrFail($id);

            $sucursal->Nombre = $validatedData['nombre'];
            $sucursal->Direccion = $validatedData['direccion'];
            $sucursal->Ubicacion = $validatedData['Ubicacion'];
            $sucursal->Estado = $validatedData['estado'];
            $sucursal->save();

            DB::commit();

            return redirect()->route('sucursales.crud')->with('success', 'Sucursal actualizada correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error al actualizar la sucursal: " . $e->getMessage());
            return response()->json(['error' => 'Error al actualizar la sucursal', 'details' => $e->getMessage()], 500);
        }
    }

    //ELIMINACION PASIVA DE LA SUCURSAL
    public function eliminarSucursal($id)
    {
        DB::beginTransaction();

        try {
            $sucursal = Sucursal::findOrFail($id);

            $sucursal->Estado = 0;
            $sucursal->save();

            DB::commit();

            return redirect()->route('sucursales.crud')->with('success', 'Sucursal desactivada correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error al desactivar la categoria con ID {$id}: " . $e->getMessage());
            return redirect()->route('crudcrudSucursales')->with('error', 'Hubo un error al desactivar la categoria');
        }
    }
}
