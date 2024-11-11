<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ControllerHome;
use App\Http\Controllers\InventarioProductoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SucursalController;
use Illuminate\Support\Facades\Route;

//Rutas con ProductoController
Route::controller(ProductoController::class)->group(function () {
    //vista home
    Route::get('/', 'mostrarCategoriasEnHome');
    //Tabla de productos
    Route::get('/crudProductos', 'crudProductos')->name('productos.crud');
    //Vista para crear productos
    Route::get('/crearProducto', 'crearProductosView')->name('productos.crear');
    //Crear productos
    Route::post('/productos/crear', 'create')->name('productos.store');
    //Vista para editar producto
    Route::get('/editarProducto/{id}', 'editarProductosView')->name('editarProducto');
    //Editar producto
    Route::put('/productos/editar/{id}', 'update')->name('productos.update');
    //Desactivar producto
    Route::patch('/eliminarProducto/{id}', 'eliminarProducto')->name('producto.eliminar');
    //Regresar productos por categorias
    Route::get('/productos/categorias/{id}', 'productosPorCategoria')->name('productos.categorias');
    //regresar todos los productos
    Route::get('/productos/categorias', 'todosLosProductos')->name('productos.todos');
    //Regresar productos por marcas
    Route::get('/productos/marcas/{id}', 'productosPorMarcas')->name('productos.marcas');
    //Vista de detalles de producto
    Route::get('/producto/{id}', 'detalleProducto')->name('productos.detalle');
});

Route::controller(MarcaController::class)->group(function () {
    //Tabla de marcas
    Route::get('/crudMarcas', 'obtenerMarcas')->name('marcas.crud');
    //Vista para crear marca
    Route::get('/crearMarca', 'crearMarcasView')->name('marcas.crear');
    //Crear Marca
    Route::post('/marcas/crear', 'create')->name('marcas.store');
    //Vista para editar marca
    Route::get('/editarMarca/{id}', 'editarMarcaView')->name('editarMarca');
    //Editar marca
    Route::put('/marca/editar/{id}', 'update')->name('marcas.update');
    //Desactivar marca
    Route::patch('/eliminarMarca/{id}', 'eliminarMarca')->name('marcas.eliminar');
});

Route::controller(CategoriasController::class)->group(function () {
    //Tabla de categorias
    Route::get('/crudCategorias', 'obtenerCategorias')->name('categorias.crud');
    //Vista para crear categoria
    Route::get('/crearCategoria', 'crearCategoriasView')->name('categorias.crear');
    //Crear categorias
    Route::post('/categorias/crear', 'create')->name('categorias.store');
    //Vista para editar categoria
    Route::get('/editarCategoria/{id}', 'editarCategoriaView')->name('editarCategoria');
    //Editar categoria
    Route::put('categoria/editar/{id}', 'update')->name('categorias.update');
    //Desactivar categoria
    Route::patch('/eliminarCategoria/{id}', 'eliminarCategoria')->name('categorias.eliminar');
});

Route::controller(SucursalController::class)->group(function () {
    //Tabla de sucursales
    Route::get('/crudSucursales', 'obtenerSucursales')->name('sucursales.crud');
    //Vista para crear sucrusales
    Route::get('/crearSucursal', 'crearSucursalView')->name('sucursales.crear');
    //Crear sucursales
    Route::post('/sucursales/crear', 'create')->name('sucursales.store');
    //Vista para editar sucursal
    Route::get('/editarSucursal/{id}', 'editarSucursalView')->name('editarSucursal');
    //Editar sucursal
    Route::put('sucursal/editar/{id}', 'update')->name('sucursales.update');
    //Desactivar Sucursal
    Route::patch('eliminarSucursal/{id}', 'eliminarSucursal')->name('sucursales.eliminar');
});

Route::controller(InventarioProductoController::class)->group(function () {
    //Tabla de inventario productos
    Route::get('/crudInventarioProducto/{id}', 'obtenerInventarioProducto')->name('inventarioProducto.crud');
    //Vista para crear existencias y productos en inventario 
    Route::get('/crearExistenciaInventario', 'crearExistenciaInventario')->name('inventarioProducto.crear');
    //crear existencia y productos en inventario
    Route::post('/inventarioProducto/crear', 'create')->name('inventarioProducto.store');
    //Vista para agregar existencia en inventario (El id es del inventario/sucursal)
    Route::get('/editarExistenciaInventario/{id}', 'editarInventarioPorductoView')->name('editarInventarioProducto');
    //Agregar existencia a inventario (el id es del inventario/sucursal);
    Route::put('/inventarioPorducto/editar/{id}', 'update')->name('inventarioProducto.update');
});

//carrito
Route::get('/carrito', function () {
    return view('carrito');
});

Route::get('/checkout', function () {
    return view('checkout');
});

//rutas para usuarios y roles
// Autenticación
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Gestión de Roles
Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
Route::post('/roles/assign/{userId}', [RoleController::class, 'assignRole'])->name('roles.assign');
Route::post('/roles/remove/{userId}', [RoleController::class, 'removeRole'])->name('roles.remove');

