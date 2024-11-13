<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto final</title>
    <link rel="icon" href="{{ asset('img/favicon.png') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- animate CSS -->
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <!-- nice select CSS -->
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/price_rangs.css') }}">
    <!-- style CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet" href="https://unpkg.com/ag-grid-community/styles/ag-grid.css">
    <link rel="stylesheet" href="https://unpkg.com/ag-grid-community/styles/ag-theme-alpine.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS (y Popper.js si es necesario) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/ag-grid-community/dist/ag-grid-community.noStyle.js"></script>
</head>

<body>

    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="/">
                            Store Online S.A
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="menu_icon"><i class="fas fa-bars"></i></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="/">Inicio</a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_1"
                                        role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Tienda
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown_1">
                                        <a class="dropdown-item" href="{{ route('productos.todos') }}">
                                            Tienda por categorías
                                        </a>
                                    </div>
                                </li>
                                @if (Auth::check() && Auth::user()->hasRole('Gerente'))
                                    <!-- Código para mostrar opciones de administración -->
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_1"
                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Usuarios
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown_1">
                                            <a class="dropdown-item" href="{{ url('crudUsuarios') }}"> Administrar
                                                usuarios</a>
                                        </div>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_1"
                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Inventario
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown_1">
                                            <a class="dropdown-item" href="{{ url('crearTraslado') }}"> Traslados</a>
                                        </div>
                                    </li>
                                @endif

                                <!-- Solo se muestra si el usuario tiene el rol de admin -->
                                @if (Auth::check() && Auth::user()->hasRole('Admin'))
                                    <!-- Código para mostrar opciones de administración -->
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_1"
                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Administracion
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown_1">
                                            <a class="dropdown-item" href="{{ url('crudProductos') }}"> Productos</a>
                                            <a class="dropdown-item" href="{{ url('crudMarcas') }}">Marcas</a>
                                            <a class="dropdown-item"
                                                href="{{ url('crudCategorias') }}">Categorias</a>
                                            <a class="dropdown-item"
                                                href="{{ url('crudSucursales') }}">Sucursales</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_1"
                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Administracion Tienda
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown_1">
                                            <a class="dropdown-item"
                                                href="{{ route('inventarioProducto.crud', 1) }}">
                                                Existencias
                                            </a>
                                        </div>
                                    </li>
                                @endif



                                <li class="nav-item dropdown" style="margin-top: 20px">
                                    <a href="/carrito" id="cart-icon" role="button">
                                        <i>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d=" M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3
                                                0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114
                                                60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0
                                                .75.75 0 0 1 1.5 0Z" />
                                            </svg>
                                        </i>
                                        <span id="contador-carrito"
                                            style="position: absolute; right: -10px; background-color: red; color: white; border-radius: 50%; padding: 2px 6px; font-size: 12px; font-weight: bold;">
                                            0
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- Iconos y opciones de usuario en pantallas grandes -->
                        <div class="d-none d-md-flex align-items-center gap-3">
                            @if (Auth::check())
                                <span>Bienvenido(a), {{ Auth::user()->Usuario }}</span>
                                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                    @csrf
                                    <button type="submit" class="genric-btn primary-border circle">Cerrar
                                        sesión</button>
                                </form>
                            @else
                                <a href="{{ route('register') }}"
                                    class="genric-btn primary-border circle">Registrarse</a>
                                <a href="{{ route('login') }}" class="genric-btn success-border circle">Iniciar
                                    sesión</a>
                            @endif
                        </div>

                        <!-- Versión colapsable para dispositivos móviles -->
                        <div class="d-md-none">
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#mobileUserOptions" aria-controls="mobileUserOptions"
                                aria-expanded="false" aria-label="Toggle navigation" style="margin-left: 80%;">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="mobileUserOptions">
                                <ul class="navbar-nav" style="margin-left: auto; text-align: right;">
                                    @if (Auth::check())
                                        <li class="nav-item">
                                            <span class="nav-link">Bienvenido(a), {{ Auth::user()->Usuario }}</span>
                                        </li>
                                        <li class="nav-item">
                                            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                                @csrf
                                                <button type="submit"
                                                    class="genric-btn primary-border circle nav-link">Cerrar
                                                    sesión</button>
                                            </form>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a href="{{ route('register') }}"
                                                class="genric-btn primary-border circle nav-link">Registrarse</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('login') }}"
                                                class="genric-btn success-border circle nav-link">Iniciar sesión</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                    </nav>
                </div>
            </div>
        </div>
    </header>
    @yield('content')

    <script src="{{ asset('js/jquery-1.12.1.min.js') }}"></script>
    <!-- popper js -->
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- easing js -->
    <script src="{{ asset('js/jquery.magnific-popup.js') }}"></script>
    <!-- swiper js -->
    <script src="{{ asset('js/swiper.min.js') }}"></script>
    <!-- swiper js -->
    <script src="{{ asset('js/masonry.pkgd.js') }}"></script>
    <!-- particles js -->
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <!-- slick js -->
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/contact.js') }}"></script>
    <script src="{{ asset('js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('js/jquery.form.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/mail-script.js') }}"></script>
    <script src="{{ asset('js/stellar.js') }}"></script>
    <script src="{{ asset('js/price_rangs.js') }}"></script>
    <!-- custom js -->
    <script src="{{ asset('js/custom.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            actualizarContadorCarrito();
        });

        function actualizarContadorCarrito() {
            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

            let cantidadTotal = carrito.length;

            const contadorCarrito = document.getElementById('contador-carrito');

            if (contadorCarrito) {
                contadorCarrito.textContent = cantidadTotal;
            }
        }
    </script>

</body>

</html>
