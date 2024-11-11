@extends('templateHeader')

@section('content')
    <section class="feature_part padding_top" style="margin-bottom: 50px">
        <div class="container">
            <div>
                <h1>Crear Sucursal</h1>
                <a class="genric-btn success" href="/crudSucursales" style="height: 40px; margin-top: 5px;">
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
                <form action="{{ route('sucursales.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-span-2 row-span-5" style="margin-top: 20px;">
                        <div class="mt-10">
                            <h5>Sucursal:</h5>
                            <input type="text" name="nombre" style="width: 50%;" placeholder="Sucursal"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Sucursal'" required
                                class="single-input">
                        </div>
                        <div class="mt-10">
                            <h5>Direccion:</h5>
                            <input type="text" name="direccion" style="width: 50%;" placeholder="Direccion"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Direccion'" required
                                class="single-input">
                        </div>
                        <div class="mt-10">
                            <h5>Ubicacion:</h5>
                            <input type="text" name="Ubicacion" style="width: 50%;" placeholder="Ubicacion"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ubicacion'"
                                class="single-input">
                        </div>

                        <button type="submit" class="genric-btn success" style="margin-top: 40px;">
                            Guardar Sucursal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
