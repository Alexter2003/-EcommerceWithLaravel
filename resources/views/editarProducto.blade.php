@extends('templateHeader')

@section('content')
    <section class="feature_part padding_top" style="margin-bottom: 50px">
        <div class="container">
            <h1>EDITAR PRODUCTOS</h1>
            <a class="genric-btn success" href="/crudProductos" style="height: 40px; margin-top: 5px;">
                Regresar
            </a>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="grid grid-cols-5 grid-rows-5 gap-4">
                <form action="{{ route('productos.update', $producto->idProductos) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-span-2 row-span-5" style="margin-top: 20px;">
                        <div class="mt-10">
                            <h5>Nombre del producto</h5>
                            <input type="text" name="nombre" style="width: 50%;" placeholder="Producto"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Producto'" required
                                class="single-input" value="{{ $producto->Nombre }}">
                        </div>

                        <div class="mt-10">
                            <h5>Descripcion del producto</h5>
                            <input type="text" name="descripcion" style="width: 50%" placeholder="Descripcion"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Descripcion'" required
                                class="single-input" value="{{ $producto->Descripcion }}">
                        </div>

                        <div class="mt-10">
                            <h5>Fotografia del producto</h5>
                            <input type="file" name="imagen" style="width: 50%;">
                        </div>

                        <div class="mt-10">
                            <h5>Precio de venta</h5>
                            <input type="number" name="precioVenta" style="width: 50%;" placeholder="Precio de venta"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Precio de venta'"
                                value="{{ $producto->ultimoPrecioVenta }}" required>
                        </div>

                        <div class="mt-10">
                            <h5>Precio de compra</h5>
                            <input type="number" name="precioCompra" style="width: 50%;" placeholder="Precio de compra"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Precio de compra'"
                                value="{{ $producto->ultimoPrecioCompra }}" required>
                        </div>

                        <div class="single-element-widget mt-30">
                            <h5>Marca</h5>
                            <div class="default-select" id="default-select_2">
                                <select name="idMarcas" required>
                                    @foreach ($marcas as $marca)
                                        <option value="{{ $marca->idMarcas }}"
                                            {{ $marca->idMarcas == $producto->idMarcas ? 'selected' : '' }}>
                                            {{ $marca->Nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="single-element-widget mt-30">
                            <h5>Categorias</h5>
                            <div class="default-select" id="default-select_2">
                                <select name="idCategoria" required>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->idCategorias }}"
                                            {{ $categoria->idCategorias == $producto->idCategoria ? 'selected' : '' }}>
                                            {{ $categoria->Nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="single-element-widget mt-30">
                            <h5>Estado</h5>
                            <div class="default-select" id="default-select_2">
                                <select name="estado" required>
                                    <option value="1" {{ $producto->Estado == 1 ? 'selected' : '' }}>
                                        Activo
                                    </option>
                                    <option value="0" {{ $producto->Estado == 0 ? 'selected' : '' }}>
                                        Inactivo
                                    </option>
                                </select>
                            </div>
                        </div>


                        <button type="submit" class="genric-btn success" style="margin-top: 40px;">
                            Editar producto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
