<?php

namespace App\Http\Controllers;

use App\Models\InventarioProducto;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\PedidosProducto;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function verCheckout()
    {
        // Verificar si el usuario esta logeado
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Debe ingresar al sistema para proceder.');
        }

        // Verificar si ya existe un cliente para el usuario
        $cliente = Cliente::where('idUsuario', Auth::id())->first();

        return view('checkout', compact('cliente'));
    }

    public function createPedido(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'Nombres' => 'required|string|max:255',
            'Apellidos' => 'required|string|max:255',
            'Telefono' => 'required|string|max:255',
            'Correo' => 'required|email|max:255',
            'Direccion' => 'required|string|max:255',
            'Nit' => 'required|string|max:255',
            'Departamento' => 'required|string|max:255',
            'Municipio' => 'required|string|max:255',
        ]);

        // Verificar si el usuario esta logeado
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Debe ingresar al sistema para proceder.');
        }

        // Obtener el carrito del json del localStorage
        $carrito = json_decode($request->input('carrito'), true);
        if (empty($carrito)) {
            return redirect()->back()->with('error', 'El carrito está vacío.');
        }

        // Obtener el metodo de pago seleccionado
        $metodoPago = $request->input('metodoPago'); // 'pendiente' o 'pagado'

        // Asignar el estado de pago 
        $estadoPago = $metodoPago === 'pagado' ? 2 : 1; // 2 = pagado, 1 = pendiente

        DB::beginTransaction();

        try {
            // Crear o actualizar el cliente
            $cliente = Cliente::updateOrCreate(
                ['idUsuario' => Auth::id()],
                $validated
            );

            // Crear el pedido
            $pedido = Pedido::create([
                'FechaPedido' => now(),
                'idClientes' => $cliente->idClientes,
                'idEstadoPago' => $estadoPago,
                'idEstadoPedido' => 1,
            ]);

            // Crear los productos en el pedido y actualizar el inventario
            foreach ($carrito as $item) {
                $producto = Producto::find($item['idProducto']);
                $total = $producto->ultimoPrecioVenta * $item['cantidad'];

                // Buscar el inventario de ese producto en la sucursal indicada
                $inventario = InventarioProducto::where('idProductos', $item['idProducto'])
                    ->where('idSucursal', $item['idSucursal'])
                    ->first();

                // Verificar si hay suficiente cantidad en el inventario
                if ($inventario && $inventario->Cantidad >= $item['cantidad']) {
                    $inventario->Cantidad -= $item['cantidad'];
                    $inventario->save();

                    // Crear el registro de productos en el pedido
                    PedidosProducto::create([
                        'Cantidad' => $item['cantidad'],
                        'idPedidos' => $pedido->idPedidos,
                        'idProductos' => $item['idProducto'],
                        'Total' => $total,
                    ]);
                } else {
                    // Si no hay suficiente cantidad en la sucursal, tirar un error
                    return redirect()->back()->with('error', 'No hay suficiente cantidad en la sucursal seleccionada para el producto: ' . $producto->Nombre . 'Selecciona otra sucursal');
                }
            }

            DB::commit();

            return redirect('/')->with('success', 'Pedido realizado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error al crear el pedido: " . $e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
