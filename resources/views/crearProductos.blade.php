@extends('templateHeader')

@section('content')
    <section class="feature_part padding_top" style="margin-bottom: 50px">
        <div class="container">
            <div>
                <h1>CREAR PRODUCTOS</h1>
                <a class="genric-btn success" href="/crudProductos" style="height: 40px; margin-top: 5px;">
                    Regresar
                </a>
            </div>
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
                <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-span-2 row-span-5" style="margin-top: 20px;">
                        <div class="mt-10">
                            <h5>Nombre del producto</h5>
                            <input type="text" name="nombre" style="width: 50%;" placeholder="Producto"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Producto'" required
                                class="single-input">
                        </div>

                        <div class="mt-10">
                            <h5>Descripcion del producto</h5>
                            <input type="text" name="descripcion" style="width: 50%" placeholder="Descripcion"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Descripcion'" required
                                class="single-input">
                        </div>

                        <div class="mt-10">
                            <h5>Fotografia del producto</h5>
                            <input type="file" name="imagen" style="width: 50%;" required>
                        </div>

                        <div class="mt-10">
                            <h5>Precio de venta</h5>
                            <input type="number" name="precioVenta" style="width: 50%;" placeholder="Precio de venta"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Precio de venta'" required>
                        </div>

                        <div class="mt-10">
                            <h5>Precio de compra</h5>
                            <input type="number" name="precioCompra" style="width: 50%;" placeholder="Precio de compra"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Precio de compra'" required>
                        </div>

                        <div class="single-element-widget mt-30">
                            <h5>Marca</h5>
                            <div class="default-select" id="default-select_2">
                                <select name="idMarcas" required>
                                    @foreach ($marcas as $marca)
                                        <option value="{{ $marca->idMarcas }}">{{ $marca->Nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="single-element-widget mt-30">
                            <h5>Categorias</h5>
                            <div class="default-select" id="default-select_2">
                                <select name="idCategoria" required>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->idCategorias }}">{{ $categoria->Nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <button type="submit" class="genric-btn success" style="margin-top: 40px;">
                            Guardar producto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
