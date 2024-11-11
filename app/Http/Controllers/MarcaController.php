<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Factory;

class MarcaController extends Controller
{
    //TABLA DE MARCAS
    public function obtenerMarcas()
    {
        $marcas = Marca::all();
        return view('marcasCrud', ['marcas' => $marcas]);
    }

    //CREAR MARCAS NUEVAS
    public function create(Request $request)
    {
        DB::beginTransaction();

        try {
            // Validar datos
            $validatedData = $request->validate([
                'nombre' => 'required',
            ]);

            // Crear el nueva marca
            $marca = new Marca();
            $marca->Nombre = $validatedData['nombre'];
            $marca->save();

            DB::commit();

            return redirect()->route('marcas.crud')->with('success', 'Marca creada exitosamente');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error al crear la marca : " . $e->getMessage());
            return response()->json(['error' => 'Error al crear la marca', 'details' => $e->getMessage()], 500);
        }
    }

    public function crearMarcasView()
    {
        return view('crearMarcas');
    }

    public function editarMarcaView($id)
    {
        $marca = Marca::findOrFail($id);
        return view('editarMarca', ['marca' => $marca]);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            // Validar datos
            $validatedData = $request->validate([
                'nombre' => 'required',
                'estado' => 'required|numeric',
            ]);

            //BUSCAR LA MARCA
            $marca = Marca::findOrFail($id);

            $marca->Nombre = $validatedData['nombre'];
            $marca->estado = $validatedData['estado'];
            $marca->save();

            DB::commit();

            return redirect()->route('marcas.crud')->with('success', 'Marca actualizada correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error al actualizar el producto: " . $e->getMessage());
            return response()->json(['error' => 'Error al actualizar la marca', 'details' => $e->getMessage()], 500);
        }
    }

    //ELIMINACION PASIVA DE LA MARCA
    public function eliminarMarca($id)
    {
        DB::beginTransaction();

        try {
            $marca = Marca::findOrFail($id);

            $marca->Estado = 0;
            $marca->save();

            DB::commit();

            return redirect()->route('marcas.crud')->with('success', 'Marca desactivada correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error al desactivar la marca con ID {$id}: " . $e->getMessage());
            return redirect()->route('crudProductos')->with('error', 'Hubo un error al desactivar la marca');
        }
    }
}
