<?php

namespace App\Http\Controllers;

use App\Models\InventarioProducto;
use App\Models\Producto;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventarioProductoController extends Controller
{
    //Tabla de existencia en diferentes inventarios
    public function obtenerInventarioProducto($id)
    {
        $inventario = DB::table('viewInventarioProducto')->where('idSucursal', '=', $id)->get();
        $sucursales = Sucursal::all();
        return view('inventarioProductosCrud', ['inventario' => $inventario, 'sucursales' => $sucursales, 'idSucursalSeleccionada' => $id]);
    }

    //View para crear existencia en inventario
    public function crearExistenciaInventario()
    {
        $sucursales = Sucursal::all();
        $productos = Producto::all();
        return view('crearExistenciaInventario', ['sucursales' => $sucursales, 'productos' => $productos]);
    }

    //Crear existencia
    public function create(Request $request)
    {
        DB::beginTransaction();

        try {
            // Validar datos
            $validatedData = $request->validate([
                'idSucursal' => 'required',
                'idProductos' => 'required',
                'Cantidad' => 'required',
                'Lote' => 'required'
            ]);

            $fecha = date('Y-m-d H:i:s');

            // Verificar si ya existe un registro con la misma idSucursal e idProductos
            $inventario = InventarioProducto::where('idSucursal', '=', $validatedData['idSucursal'])
                ->where('idProductos', '=', $validatedData['idProductos'])
                ->first();

            if ($inventario) {
                $inventario->Cantidad += $validatedData['Cantidad'];
                $inventario->Lote = $validatedData['Lote'];
                $inventario->fechaCompra = $fecha;
                $inventario->save();
            } else {
                // Si no existe, crear una nueva existencia
                $inventario = new InventarioProducto();
                $inventario->idSucursal = $validatedData['idSucursal'];
                $inventario->idProductos = $validatedData['idProductos'];
                $inventario->Cantidad = $validatedData['Cantidad'];
                $inventario->fechaCompra = $fecha;
                $inventario->Lote = $validatedData['Lote'];
                $inventario->save();
            }

            DB::commit();

            return redirect()->route('inventarioProducto.crud', 1)->with('success', 'Se ingreso o actualizó la existencia correctamente');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error al insertar existencia: " . $e->getMessage());
            return response()->json(['error' => 'Error al insertar existencia:', 'details' => $e->getMessage()], 500);
        }
    }


}
