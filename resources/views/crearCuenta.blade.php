@extends('templateHeader')

@section('content')
    <section class="login_part padding_top">
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
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_form">
                        <div class="login_part_form_iner">
                            <h3>Registro <br>
                                Por favor registrate en nuestra pagina</h3>
                            <form class="row contact_form" action="{{ route('register') }}" method="post"
                                novalidate="novalidate">
                                @csrf
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="Usuario" name="Usuario" value=""
                                        placeholder="Usuario" required>
                                </div>

                                <div class="col-md-12 form-group p_star">
                                    <input type="password" class="form-control" id="password" name="password"
                                        value="" placeholder="Contraseña" required>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" value="" placeholder="Confirmar Contraseña"
                                        required>
                                </div>
                                <div class="col-md-12 form-group">
                                    <button type="submit" class="btn_3">Registrarse</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
