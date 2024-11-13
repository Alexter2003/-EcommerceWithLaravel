@extends('templateHeader')

@section('content')
    <!--================Checkout Area =================-->
    <section class="checkout_area padding_top">
        <div class="container">
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
            <div class="returning_customer">
                @if (!Auth::check())
                    <div class="check_title">
                        <h2>
                            Tienes una cuenta?
                            <a href="/login">Click aqui para iniciar sesión</a>
                        </h2>
                    </div>
                    <p style="margin-bottom: 40px">
                        Si no tienes una cuenta, debes ingresar tus datos para proceder a la compra
                    </p>
                @endif
                <div class="billing_details">
                    <div class="row">
                        <div class="col-lg-8">
                            <form class="row contact_form" action="{{ route('checkout.create') }}" method="post"
                                novalidate="novalidate">
                                @csrf
                                <h2 style="margin-bottom: 25px">Datos del cliente</h2>
                                <!-- Formulario de Datos del Cliente -->
                                <div class="col-md-6 form-group p_star">
                                    <h6>Nombres</h6>
                                    <input type="text" name="Nombres" style="width: 50%;" placeholder="Nombres" required
                                        class="single-input">
                                </div>
                                <div class="col-md-6 form-group p_star">
                                    <h6>Apellidos</h6>
                                    <input type="text" name="Apellidos" style="width: 50%;" placeholder="Apellidos"
                                        required class="single-input">
                                </div>
                                <div class="col-md-6 form-group p_star">
                                    <h6>Telefono</h6>
                                    <input type="number" name="Telefono" style="width: 50%;" placeholder="Telefono"
                                        required class="single-input">
                                </div>
                                <div class="col-md-6 form-group p_star">
                                    <h6>Correo</h6>
                                    <input type="text" name="Correo" style="width: 50%;" placeholder="Correo" required
                                        class="single-input">
                                </div>
                                <div class="col-md-6 form-group p_star">
                                    <h6>Nit</h6>
                                    <input type="number" name="Nit" style="width: 50%;" placeholder="Nit" required
                                        class="single-input">
                                </div>

                                <h2 style="margin-bottom: 20px">Datos de dirección</h2>
                                <!-- Formulario de Datos de Dirección -->
                                <div class="col-md-6 form-group p_star">
                                    <h6>Direccion</h6>
                                    <input type="text" name="Direccion" style="width: 50%;" placeholder="Direccion"
                                        required class="single-input">
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <h6>Departamento</h6>
                                    <input type="text" name="Departamento" style="width: 50%;" placeholder="Departamento"
                                        required class="single-input">
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <h6>Municipio</h6>
                                    <input type="text" name="Municipio" style="width: 50%;" placeholder="Municipio"
                                        required class="single-input">
                                </div>
                                <div class="col-md-12 form-group">
                                    <h6>Codigo postal</h6>
                                    <input type="text" name="CodigoPostal" style="width: 50%;"
                                        placeholder="Codigo postal" required class="single-input">
                                </div>
                                <h2 style="margin-bottom: 20px">Metodo de pago</h2>
                                <div class="payment_item">
                                    <div class="radion_btn">
                                        <input type="radio" id="f-option5" name="metodoPago" value="pendiente" />
                                        <label for="f-option5">Deposito </label>
                                        <div class="check"></div>
                                    </div>
                                    <p>Deposita al número de cuenta que se te enviará por correo y debes de responder con el
                                        comprobante de pago.</p>
                                </div>
                                <div class="payment_item active">
                                    <div class="radion_btn">
                                        <input type="radio" id="f-option6" name="metodoPago" value="pagado" />
                                        <label for="f-option6">Tarjeta </label>
                                        <img src="img/product/single-product/card.jpg" alt="" />
                                        <div class="check"></div>
                                    </div>
                                    <p>Por favor, ingresa tu tarjeta para poder realizar el cobro.</p>
                                </div>
                                <!-- Campo oculto para el carrito -->
                                <input type="hidden" name="carrito" id="carrito">

                                <div style="display: flex; gap: 20px">
                                    <div>
                                        <a class="btn_3" href="#">Cancelar pedido</a>
                                    </div>
                                    <div>
                                        <button class="btn_2" type="submit">Terminar compra</button>
                                    </div>
                                </div>
                            </form>


                        </div>
                        <div class="col-lg-4">
                            <div class="order_box">
                                <h2>Tu Pedido</h2>
                                <ul class="list" id="order-list">
                                    <!-- Aquí se mostrarán los productos desde el LocalStorage -->
                                </ul>
                                <ul class="list list_2">
                                    <li>
                                        <a href="#">Subtotal <span id="subtotal">Q0.00</span></a>
                                    </li>
                                    <li>
                                        <a href="#">Envio<span>Q50.00</span></a>
                                    </li>
                                    <li>
                                        <a href="#">Total <span id="total">Q0.00</span></a>
                                    </li>
                                </ul>



                            </div>
                        </div>
                    </div>
                </div>
    </section>
    <!--================End Checkout Area =================-->

    <script>
        // Obtener el carrito desde localStorage
        const carrito = JSON.parse(localStorage.getItem('carrito')) || [];

        // Verificar si el carrito está vacío
        if (carrito.length === 0) {
            alert('El carrito está vacío');
        } else {
            // Función para actualizar la vista con los productos
            function actualizarCarrito() {
                let subtotal = 0; // Reiniciar el subtotal

                const orderList = document.getElementById('order-list');
                const subtotalElement = document.getElementById('subtotal');
                const totalElement = document.getElementById('total');
                orderList.innerHTML = ''; // Limpiar lista de productos

                carrito.forEach(item => {
                    const productElement = document.createElement('li');
                    productElement.innerHTML = `
                        <a href="#">
                            ${item.nombreProducto} <span class="middle">x ${item.cantidad}</span>
                            <span class="last">Q${(item.ultimoPrecioVenta * item.cantidad).toFixed(2)}</span>
                        </a>
                    `;
                    orderList.appendChild(productElement);
                    subtotal += item.ultimoPrecioVenta * item.cantidad;
                });

                const shipping = 50.00; // Envío fijo
                const total = subtotal + shipping;
                subtotalElement.innerText = `Q${subtotal.toFixed(2)}`;
                totalElement.innerText = `Q${total.toFixed(2)}`;

                // Coloca el carrito en el campo oculto antes de enviar el formulario
                document.getElementById('carrito').value = JSON.stringify(carrito);
            }

            // Llamar a la función para actualizar el carrito
            actualizarCarrito();
        }
    </script>
@endsection
