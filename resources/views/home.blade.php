@extends('templateHeader')

@section('content')
    <!-- banner part start-->
    <section class="banner_part">
        <div class="container">
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
                                                    <a href="#" class="btn_2">buy now</a>
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
@endsection
