<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Factory;

class CategoriasController extends Controller
{
    //TABLA DE CATEGORIAS
    public function obtenerCategorias()
    {
        $categorias = Categoria::all();
        return view('categoriasCrud', ['categorias' => $categorias]);
    }

    public function crearCategoriasView()
    {
        return view('crearCategorias');
    }
    //CREAR CATEGORIAS NUEVAS
    public function create(Request $request)
    {
        DB::beginTransaction();

        try {
            // Validar datos
            $validatedData = $request->validate([
                'nombre' => 'required',
                'descripcion' => 'required'
            ]);

            // Crear el nueva categoria
            $categoria = new Categoria();
            $categoria->Nombre = $validatedData['nombre'];
            $categoria->Descripcion = $validatedData['descripcion'];
            $categoria->save();

            DB::commit();

            return redirect()->route('categorias.crud')->with('success', 'Categoria creada exitosamente');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error al crear la categoria: " . $e->getMessage());
            return response()->json(['error' => 'Error al crear la categoria', 'details' => $e->getMessage()], 500);
        }
    }
    //VIEW PARA EDITAR CATEGORIAS
    public function editarCategoriaView($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('editarCategoria', ['categoria' => $categoria]);
    }

    //EDITAR CATEGORIAS
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            // Validar datos
            $validatedData = $request->validate([
                'nombre' => 'required',
                'descripcion' => 'required',
                'estado' => 'required|numeric',
            ]);

            //BUSCAR LA CATEGORIA
            $categoria = Categoria::findOrFail($id);

            $categoria->Nombre = $validatedData['nombre'];
            $categoria->Descripcion = $validatedData['descripcion'];
            $categoria->estado = $validatedData['estado'];
            $categoria->save();

            DB::commit();

            return redirect()->route('categorias.crud')->with('success', 'Categoria actualizada correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error al actualizar la categoria: " . $e->getMessage());
            return response()->json(['error' => 'Error al actualizar la categoria', 'details' => $e->getMessage()], 500);
        }
    }

    //ELIMINACION PASIVA DE LA CATEGORIA
    public function eliminarCategoria($id)
    {
        DB::beginTransaction();

        try {
            $categoria = Categoria::findOrFail($id);

            $categoria->Estado = 0;
            $categoria->save();

            DB::commit();

            return redirect()->route('categorias.crud')->with('success', 'Categoria desactivada correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error al desactivar la categoria con ID {$id}: " . $e->getMessage());
            return redirect()->route('crudCategorias')->with('error', 'Hubo un error al desactivar la categoria');
        }
    }
}
