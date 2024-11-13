@extends('templateHeader')

@section('content')
    <!-- banner part start-->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <section class="banner_part">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                <script>
                    localStorage.removeItem('carrito'); // Esto borra el carrito guardado en localStorage
                </script>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="banner_slider owl-carousel">

                        @foreach ($productos as $producto)
                            @if ($producto->Estado != 0 && $producto->EstadoMarca != 0)
                                <div class="single_banner_slider">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-8">
                                            <div class="banner_text">
                                                <div class="banner_text_iner">
                                                    <h1>{{ $producto->Nombre }}</h1>
                                                    <p>{{ $producto->Descripcion }}</p>
                                                    <a href="/producto/{{ $producto->idProductos }}" class="btn_2">buy
                                                        now</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="banner_img d-none d-lg-block"
                                            style="max-width: 50%; margin: 0 auto; text-align: center;">
                                            <img src="{{ $producto->UrlProducto }}" alt="{{ $producto->Nombre }}"
                                                style="width: 100%; height: auto; object-fit: cover; max-height: 500px; margin-top: -40px;">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </section>
    <section class="feature_part padding_top">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section_tittle text-center">
                        <h2>CATEGORIAS</h2>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-7 col-sm-6">
                    <div class="single_feature_post_text">
                        <img src="{{ asset('img/laptopCategoria.png') }}" alt="" style="width: 70%; ">
                        <p>LAPTOPS</p>
                        <h3>Lo ultimo en computadoras portatiles</h3>
                        <a href="{{ route('productos.categorias', 1) }}" class="feature_btn">EXPLORA AHORA </a>

                    </div>
                </div>
                <div class="col-lg-5 col-sm-6">
                    <div class="single_feature_post_text">
                        <p>CELULARES</p>
                        <h3>Celulares de ultima generación</h3>
                        <a href="{{ route('productos.categorias', 2) }}" class="feature_btn">EXPLORAR AHORA</a>
                        <img src="img/GALAXY S24 ULTRA.png" alt="" style="width: 70%;">
                    </div>
                </div>
                <div class="col-lg-5 col-sm-6">
                    <div class="single_feature_post_text">
                        <p>BOCINAS</p>
                        <h3>Bocinas de alta fidelidad de audio</h3>
                        <a href="{{ route('productos.categorias', 5) }}" class="feature_btn">EXPLORAR AHORA<i
                                class="fas fa-play"></i></a>
                        <img src="img/BOCINAS CATEGORIAS.png" style="width: 70%;">
                    </div>
                </div>
                <div class="col-lg-7 col-sm-6">
                    <div class="single_feature_post_text">
                        <p>RELOJES</p>
                        <h3>Relojes inteligentes</h3>
                        <a href="{{ route('productos.categorias', 6) }}" class="feature_btn">EXPLORAR AHORA <i
                                class="fas fa-play"></i></a>
                        <img src="img/RELOJES.png" alt="" width="36%">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
