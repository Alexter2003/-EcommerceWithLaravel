@extends('templateHeader')

@section('content')
    <section class="feature_part padding_top" style="margin-bottom: 50px">
        <div class="container">
            <div>
                <h1>Crear Categoria</h1>
                <a class="genric-btn success" href="/crudCategorias" style="height: 40px; margin-top: 5px;">
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
                <form action="{{ route('categorias.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-span-2 row-span-5" style="margin-top: 20px;">
                        <div class="mt-10">
                            <h5>Categoria:</h5>
                            <input type="text" name="nombre" style="width: 50%;" placeholder="Nombre"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nombre'" required
                                class="single-input">
                        </div>
                        <div class="mt-10">
                            <h5>Descripcion de la categoria</h5>
                            <input type="text" name="descripcion" style="width: 50%" placeholder="Descripcion"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Descripcion'" required
                                class="single-input">
                        </div>

                        <button type="submit" class="genric-btn success" style="margin-top: 40px;">
                            Guardar Categoria
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
