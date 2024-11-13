@extends('templateHeader')

@section('content')
    <section class="feature_part padding_top" style="margin-bottom: 50px">
        <div class="container">
            <h1>EDITAR ROL DEL USUARIO</h1>
            <a class="genric-btn success" href="/crudUsuarios" style="height: 40px; margin-top: 5px;">
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
                <form action="{{ route('usuarios.update', $usuario->idUsuario) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-span-2 row-span-5" style="margin-top: 20px;">
                        <div class="mt-10">
                            <h5>Usuario</h5>
                            <input type="text" name="nombre" style="width: 50%;" placeholder="Producto"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Producto'" required
                                class="single-input" value="{{ $usuario->Usuario }}">
                        </div>
                        <div class="single-element-widget mt-30">
                            <h5>Rol</h5>
                            <div class="default-select" id="default-select_2">
                                <select name="idRol" required>
                                    @foreach ($roles as $rol)
                                        <option value="{{ $rol->idRol }}"
                                            {{ $rol->idRol == $usuarioRolId ? 'selected' : '' }}>
                                            {{ $rol->Nombre }}
                                        </option>
                                    @endforeach
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
