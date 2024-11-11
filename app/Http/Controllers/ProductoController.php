<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Kreait\Firebase\Factory;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\Precio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Storage;

class ProductoController extends Controller
{
    //RETORNAR TODOS LOS PRODCUTOS
    public function obtenerProductos()
    {
        return Producto::all();
    }

    //RETORNAR HOME COM PRODUCTOS DE LA VISTA DE LA DB
    public function mostrarCategoriasEnHome()
    {
        $productos = DB::table('listadoproductos')->get();
        return view('home', ['productos' => $productos]);
    }

    //RETORNAR TABLA DE PRODUCTOS
    public function crudProductos()
    {
        $productos = DB::table('listadoproductos')->get();

        return view('productosCrud', ['productos' => $productos]);
    }

    //VIEW PARA CREAR PRODUCTOS CON MARCAS Y CATEGORIAS
    public function crearProductosView()
    {
        $marcas = Marca::all();
        $categorias = Categoria::all();

        return view('crearProductos', ['marcas' => $marcas, 'categorias' => $categorias]);
    }
    //CREAR PRODUCTOS NUEVOS
    public function create(Request $request)
    {
        DB::beginTransaction();

        try {
            // Validar datos
            $validatedData = $request->validate([
                'nombre' => 'required',
                'descripcion' => 'required',
                'idMarcas' => 'required',
                'idCategoria' => 'required',
                'precioCompra' => 'required',
                'precioVenta' => 'required',
                'imagen' => 'required|image',
            ]);

            // Crear el nuevo producto
            $producto = new Producto();
            $producto->Nombre = $validatedData['nombre'];
            $producto->Descripcion = $validatedData['descripcion'];
            $producto->idMarcas = $validatedData['idMarcas'];
            $producto->idCategoria = $validatedData['idCategoria'];
            $producto->ultimoPrecioCompra = $validatedData['precioCompra'];
            $producto->ultimoPrecioVenta = $validatedData['precioVenta'];
            $producto->save();

            // Subir la imagen a Firebase
            $nombreImagen = strtolower(str_replace(' ', '_', $validatedData['nombre'])) . '.' . $request->file('imagen')->getClientOriginalExtension();
            $factory = (new Factory)
                ->withServiceAccount(base_path('firebase_credentials.json'))
                ->withDatabaseUri('https://proyectofinalsextosemestre-default-rtdb.firebaseio.com');

            $storage = $factory->createStorage();
            $bucket = $storage->getBucket();
            $imagePath = 'productos/' . $nombreImagen;
            $bucket->upload(
                fopen($request->file('imagen')->getPathname(), 'r'),
                [
                    'name' => $imagePath,
                    'predefinedAcl' => 'publicRead',  // Permite acceso público
                ]
            );
            // Obtener la URL de la imagen
            $imageUrl = sprintf('https://storage.googleapis.com/%s/%s', $bucket->name(), $imagePath);

            // Actualizar el producto con la URL de la imagen
            $producto->update(['UrlProducto' => $imageUrl]);

            DB::commit();

            return redirect()->route('productos.crear')->with('success', 'Producto creado exitosamente');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error al crear el producto: " . $e->getMessage());
            return response()->json(['error' => 'Error al crear el producto', 'details' => $e->getMessage()], 500);
        }
    }

    //VIEW PARA EDITAR PRODUCTOS
    public function editarProductosView($id)
    {
        $marcas = Marca::all();
        $categorias = Categoria::all();
        $producto = Producto::findOrFail($id);

        return view('editarProducto', ['marcas' => $marcas, 'categorias' => $categorias, 'producto' => $producto]);
    }

    //EDITAR PRODUCTOS
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            // Validar datos
            $validatedData = $request->validate([
                'nombre' => 'required',
                'descripcion' => 'required',
                'idMarcas' => 'required',
                'idCategoria' => 'required',
                'precioCompra' => 'required|numeric',
                'precioVenta' => 'required|numeric',
                'estado' => 'required|numeric',
                'imagen' => 'nullable|image',
            ]);

            //BUSCAR EL PRODUCTO
            $producto = Producto::findOrFail($id);

            $producto->Nombre = $validatedData['nombre'];
            $producto->Descripcion = $validatedData['descripcion'];
            $producto->idMarcas = $validatedData['idMarcas'];
            $producto->idCategoria = $validatedData['idCategoria'];
            $producto->ultimoPrecioCompra = $validatedData['precioCompra'];
            $producto->ultimoPrecioVenta = $validatedData['precioVenta'];
            $producto->estado = $validatedData['estado'];
            $producto->save();

            // SI SE SUBIO UNA NUEVA IMAGEN, SUBIRLA A FIREBASE Y ACTUALIZAR
            if ($request->hasFile('imagen')) {
                //SUBIR IMAGEN A FIREBASE
                $nombreImagen = strtolower(str_replace(' ', '_', $validatedData['nombre'])) . '.' . $request->file('imagen')->getClientOriginalExtension();

                $factory = (new Factory)
                    ->withServiceAccount(base_path('firebase_credentials.json'))
                    ->withDatabaseUri('https://proyectofinalsextosemestre-default-rtdb.firebaseio.com');

                $storage = $factory->createStorage();
                $bucket = $storage->getBucket();

                $imagePath = 'productos/' . $nombreImagen;
                $bucket->upload(
                    fopen($request->file('imagen')->getPathname(), 'r'),
                    ['name' => $imagePath, 'predefinedAcl' => 'publicRead']
                );

                $imageUrl = sprintf('https://storage.googleapis.com/%s/%s', $bucket->name(), $imagePath);

                // Actualizar el producto con la URL de la imagen
                $producto->update(['UrlProducto' => $imageUrl]);
            }

            DB::commit();

            return redirect()->route('productos.crud')->with('success', 'Producto actualizado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error al actualizar el producto: " . $e->getMessage());
            return response()->json(['error' => 'Error al actualizar el producto', 'details' => $e->getMessage()], 500);
        }
    }
    //ELIMINACION PASIVA DEL PRODUCTO
    public function eliminarProducto($id)
    {
        DB::beginTransaction();

        try {
            $producto = Producto::findOrFail($id);

            $producto->estado = 0;
            $producto->save();

            DB::commit();

            return redirect()->route('productos.crud')->with('success', 'Producto desactivado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error al desactivar el producto con ID {$id}: " . $e->getMessage());
            return redirect()->route('crudProductos')->with('error', 'Hubo un error al desactivar el producto');
        }
    }

    public function productosPorCategoria($id)
    {
        $marcas = Marca::all();
        $categorias = Categoria::all();
        $productos = DB::table('listadoproductos')->where('idCategorias', '=', $id)->get();
        return view('tienda', ['productos' => $productos, 'marcas' => $marcas, 'categorias' => $categorias]);
    }

    public function productosPorMarcas($id)
    {
        $marcas = Marca::all();
        $categorias = Categoria::all();
        $productos = DB::table('listadoproductos')->where('idMarcas', '=', $id)->get();
        return view('tienda', ['productos' => $productos, 'marcas' => $marcas, 'categorias' => $categorias]);
    }

    public function todosLosProductos()
    {
        $marcas = Marca::all();
        $categorias = Categoria::all();
        $productos = DB::table('listadoproductos')->get();
        return view('tienda', ['productos' => $productos, 'marcas' => $marcas, 'categorias' => $categorias]);
    }

    public function detalleProducto($id)
    {
        $sucursales = Sucursal::all();
        $producto = DB::table('listadoproductos')->where('idProductos', '=', $id)->first();
        $existenciaInventarios = DB::table('existenciaporsucursal')->where('idProductos', '=', $id)->get();
        return view('detallesProductos', ['producto' => $producto, 'existenciaInventarios' => $existenciaInventarios, 'sucursales' => $sucursales]);
    }
}
