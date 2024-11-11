@extends('templateHeader')

@section('content')
    <!--================Home Banner Area =================-->
    <!-- breadcrumb start-->
    <section class="breadcrumb breadcrumb_bg" style="position: relative; padding: 50px 0; color: #fff;">
        <!-- Imagen en posición absoluta -->
        <img src="{{ asset('img/productosCategorias.jpg') }}" alt="Imagen de productos"
            style="position: absolute; top: 20px; left: 0; width: 100%; height: 100%; opacity: 0.9; z-index: 0; object-fit: cover;">

        <div class="container" style="position: relative; z-index: 1;">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2 style="color: white">TENDA POR CATEGORIAS</h2>
                            <h5 style="color: white">Inicio <span>-</span> Tienda por categoria</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- breadcrumb start-->

    <!--================Category Product Area =================-->
    <section class="cat_product_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="left_sidebar_area">
                        <aside class="left_widgets p_filter_widgets">
                            <div class="l_w_title">
                                <h3>Categorias</h3>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
                                    @foreach ($categorias as $categoria)
                                        <li>
                                            <a
                                                href="{{ route('productos.categorias', $categoria->idCategorias) }}">{{ $categoria->Nombre }}</a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </aside>

                        <aside class="left_widgets p_filter_widgets">
                            <div class="l_w_title">
                                <h3>Filtrar por Marcas</h3>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
                                    @foreach ($marcas as $marca)
                                        <li>
                                            <a
                                                href="{{ route('productos.marcas', $marca->idMarcas) }}">{{ $marca->Nombre }}</a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </aside>
                    </div>
                </div>
                <div class="col-lg-9">

                    <div class="row align-items-center latest_product_inner">

                        @foreach ($productos as $producto)
                            <div class="col-lg-4 col-sm-6">
                                <div class="single_product_item">
                                    <img src="{{ $producto->UrlProducto }}" alt="">
                                    <div class="single_product_text">
                                        <h4>{{ $producto->Nombre }}</h4>
                                        <h3>Q{{ $producto->ultimoPrecioVenta }}</h3>
                                        <a href="{{ route('productos.detalle', $producto->idProductos) }}" class="add_cart">
                                            + add to cart
                                        </a>
                                        <a href="{{ route('productos.detalle', $producto->idProductos) }}">
                                            <i style="width: 20px; margin-top: -40px">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>
                                            </i>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
