@extends('templateHeader')

@section('content')
    <section class="feature_part padding_top" style="margin-bottom: 50px">
        <div class="container">
            <div>
                <h1>TRASLADO DE PRODUCTOS</h1>
                <a class="genric-btn success" href="/" style="height: 40px; margin-top: 5px;">
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
                <form action="{{ route('traslados.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-span-2 row-span-5" style="margin-top: 20px;">
                        <div class="single-element-widget mt-30" style="margin-bottom: 30px;">
                            <h5>Sucursal origen</h5>
                            <div class="default-select" id="default-select_2">
                                <select name="idSucursalOrigen" id="sucursalSelector" onchange="redirectToSucursal()">
                                    @foreach ($sucursales as $sucursal)
                                        <option value="{{ $sucursal->idSucursal }}">
                                            {{ $sucursal->Nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="single-element-widget mt-30" style="margin-bottom: 30px;">
                            <h5>Sucursal destino</h5>
                            <div class="default-select" id="default-select_2">
                                <select name="idSucursalDestino" id="sucursalSelector" onchange="redirectToSucursal()">
                                    @foreach ($sucursales as $sucursal)
                                        <option value="{{ $sucursal->idSucursal }}">
                                            {{ $sucursal->Nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="single-element-widget mt-30">
                            <h5>Producto a trasladar</h5>
                            <div class="default-select" id="default-select_2">
                                <select name="idProductos" required>
                                    @foreach ($productos as $producto)
                                        <option value="{{ $producto->idProductos }}">{{ $producto->Nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mt-10">
                            <h5>Cantidad</h5>
                            <input type="number" name="Cantidad" style="width: 50%;" placeholder="Cantidad"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Cantidad'" required>
                        </div>


                        <button type="submit" class="genric-btn success" style="margin-top: 40px;">
                            Generar traslado
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
