@extends('templateHeader')

@section('content')
    <!--================Cart Area =================-->
    <section class="cart_area padding_top">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="cart-items">
                            <!-- Los productos se insertarán aquí mediante JavaScript -->
                        </tbody>
                    </table>
                </div>

                <!-- Total del carrito -->
                <div class="total_area">
                    <h5>Total:</h5>
                    <h5 id="total-price">Q0.00</h5> <!-- El total será calculado por JavaScript -->
                </div>

                <!-- Botones de acción -->
                <div class="checkout_btn_inner float-right">
                    <a class="btn_1" href="/productos/categorias">Continuar Comprando</a>
                    <a class="btn_1 checkout_btn_1" href="/checkout">Proceder a la compra</a>
                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->

    <footer class="footer_part">
        <!-- Aquí va el contenido de tu footer -->
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtener los datos del carrito desde el localStorage
            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

            // Seleccionar el contenedor donde se mostrarán los productos
            const cartItemsContainer = document.getElementById('cart-items');
            const totalPriceElement = document.getElementById('total-price');
            let total = 0;

            // Función para renderizar el carrito
            function renderCart() {
                cartItemsContainer.innerHTML = '';
                total = 0;

                if (carrito.length === 0) {
                    cartItemsContainer.innerHTML =
                        '<tr><td colspan="5" class="text-center">El carrito está vacío</td></tr>';
                    totalPriceElement.innerText = 'Q0.00';
                } else {
                    carrito.forEach((item, index) => {
                        let productoSimulado = {
                            idProducto: item.idProducto,
                            nombre: item.nombreProducto,
                            imagenUrl: item.UrlProducto,
                            precio: parseFloat(item.ultimoPrecioVenta)
                        };

                        let precioTotal = productoSimulado.precio * item.cantidad;
                        total += precioTotal;

                        let tr = document.createElement('tr');
                        tr.innerHTML = `
                        <td>
                            <div class="media">
                                <div class="d-flex">
                                    <img src="${productoSimulado.imagenUrl}" alt="Imagen del producto" width="50"/>
                                </div>
                                <div class="media-body">
                                    <p>${productoSimulado.nombre}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <h5>Q${productoSimulado.precio.toFixed(2)}</h5>
                        </td>
                        <td>
                            <div class="product_count">
                                <label class="input-number" type="text">${item.cantidad}</label>
                            </div>
                        </td>
                        <td>
                            <h5>Q${precioTotal.toFixed(2)}</h5>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm" onclick="removeFromCart(${index})">Eliminar</button>
                        </td>
                    `;
                        cartItemsContainer.appendChild(tr);
                    });

                    totalPriceElement.innerText = 'Q' + total.toFixed(2);
                }
            }

            // Renderizar el carrito al cargar la página
            renderCart();

            // Definir removeFromCart globalmente
            window.removeFromCart = function(index) {
                // Eliminar el producto del carrito
                carrito.splice(index, 1);
                localStorage.setItem('carrito', JSON.stringify(carrito)); // Actualizar el localStorage

                // Actualizar la vista llamando a renderCart nuevamente
                renderCart();
            }
        });
    </script>
@endsection
