<?php

namespace App\Http\Controllers;

use App\Models\InventarioProducto;
use App\Models\Sucursal;
use App\Models\Traslado;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrasladoController extends Controller
{
    public function trasladoView()
    {
        $sucursales = Sucursal::all();
        $productos = Producto::all();
        return view('traslados', ['productos' => $productos, 'sucursales' => $sucursales]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // Validar datos de entrada
            $validatedData = $request->validate([
                'idProductos' => 'required|exists:productos,idProductos',
                'idSucursalOrigen' => 'required|exists:sucursal,idSucursal',
                'idSucursalDestino' => 'required|exists:sucursal,idSucursal',
                'Cantidad' => 'required|integer|min:1',
            ]);

            // Obtener datos de entrada
            $productoId = $validatedData['idProductos'];
            $sucursalOrigen = $validatedData['idSucursalOrigen'];
            $sucursalDestino = $validatedData['idSucursalDestino'];
            $cantidad = $validatedData['Cantidad'];
            $usuarioId = Auth::id();

            // Verificar disponibilidad en el inventario de origen
            $inventarioOrigen = InventarioProducto::where('idSucursal', '=', $sucursalOrigen)
                ->where('idProductos', '=', $productoId)
                ->first();

            if (!$inventarioOrigen || $inventarioOrigen->Cantidad < $cantidad) {
                return redirect()->back()->with('error', 'No hay suficiente cantidad en la sucursal de origen.');
            }

            // Reducir la cantidad en el inventario de origen
            $inventarioOrigen->Cantidad -= $cantidad;
            $inventarioOrigen->save();

            // Verificar si el producto existe en el inventario de destino
            $inventarioDestino = InventarioProducto::where('idSucursal', '=', $sucursalDestino)
                ->where('idProductos', '=', $productoId)
                ->first();

            if ($inventarioDestino) {
                // Aumentar la cantidad en el inventario de destino
                $inventarioDestino->Cantidad += $cantidad;
                $inventarioDestino->save();
            } else {
                // Crear un nuevo registro en el inventario de destino
                InventarioProducto::create([
                    'idSucursal' => $sucursalDestino,
                    'idProductos' => $productoId,
                    'Cantidad' => $cantidad,
                    'Lote' => $inventarioOrigen->Lote,
                    'FechaCompra' => now(),
                ]);
            }

            // Crear registro del traslado
            Traslado::create([
                'idProductos' => $productoId,
                'Fecha' => now(),
                'Estado' => 'completado',
                'Cantidad' => $cantidad,
                'idSucursal_Origen' => $sucursalOrigen,
                'idSucursal_Destino' => $sucursalDestino,
                'idUsuario' => $usuarioId,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Traslado realizado correctamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error en el traslado de productos: " . $e->getMessage());
            return redirect()->back()->with('error', 'Error en el traslado de productos: ' . $e->getMessage());
        }
    }
}
