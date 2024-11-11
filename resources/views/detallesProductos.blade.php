@extends('templateHeader')

@section('content')
    <!--================Single Product Area =================-->
    <div class="product_image_area section_padding">
        <div class="container">
            <div class="row s_product_inner justify-content-between">

                <div class="col-lg-7 col-xl-7">
                    <a class="genric-btn success" href="/productos/categorias" style="height: 40px; margin-top: 5px;">
                        Regresar
                    </a>
                    <div id="mensaje-exito" class="alert alert-success" style="display: none;">
                        Producto agregado al carrito exitosamente.
                    </div>
                    <div id="mensaje-actualizado" class="alert alert-info" style="display: none;">
                        Cantidad actualizada en el carrito.
                    </div>
                    <div class="product_slider_img">
                        <div id="vertical">
                            <div>
                                <img src="{{ $producto->UrlProducto }}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-xl-4" style="margin-top: 90px">
                    <div class="s_product_text">
                        <h3>{{ $producto->Nombre }}</h3>
                        <h2>Q{{ $producto->ultimoPrecioVenta }}</h2>
                        <ul class="list">
                            <li>
                                <label class="active">Categoria: {{ $producto->Categoria }}</label>
                            </li>

                            <li>
                                <h6 class="active">Existencias: </h6>
                            </li>
                            <li>
                                @foreach ($existenciaInventarios as $existenciaInventario)
                                    <div>
                                        <label>{{ $existenciaInventario->Sucursal }}:
                                            {{ $existenciaInventario->Cantidad }}</label>
                                    </div>
                                @endforeach
                            </li>
                        </ul>

                        <p>
                            {{ $producto->Descripcion }}
                        </p>
                        <div class="single-element-widget mt-30">
                            <h5>Elija sucursal para comprar:</h5>
                            <div class="default-select" id="default-select_2">
                                <select name="idSucursal" id="select-sucursal" required>
                                    @foreach ($sucursales as $sucursal)
                                        <option value="{{ $sucursal->idSucursal }}">{{ $sucursal->Nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card_area d-flex justify-content-between align-items-center">
                            <div class="product_count">
                                <span class="inumber-decrement"> - </span>
                                <input class="input-number" type="text" value="1" min="1" max="10">
                                <span class="number-increment"> + </span>
                            </div>
                            <a href="#" class="btn_3" data-idproducto="{{ $producto->idProductos }}"
                                data-ultimoPrecioVenta="{{ $producto->ultimoPrecioVenta }}"
                                data-nombreProducto="{{ $producto->Nombre }}" data-url="{{ $producto->UrlProducto }}">
                                Agregar a carrito
                            </a>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelector('.btn_3').addEventListener('click', function(event) {

                const idSucursal = document.getElementById('select-sucursal').value;
                const idProducto = this.getAttribute('data-idproducto');
                const ultimoPrecioVenta = this.getAttribute('data-ultimoPrecioVenta');
                const nombreProducto = this.getAttribute('data-nombreProducto');
                const UrlProducto = this.getAttribute('data-url');

                const cantidad = parseInt(this.closest('.card_area').querySelector('.input-number').value);

                if (!idSucursal) {
                    alert('Por favor, elija una sucursal');
                    return;
                }

                if (cantidad <= 0) {
                    alert('La cantidad debe ser mayor a 0');
                    return;
                }

                let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

                const index = carrito.findIndex(item => item.idProducto === idProducto && item
                    .idSucursal === idSucursal && item.ultimoPrecioVenta == ultimoPrecioVenta);

                if (index === -1) {
                    // Agregar el producto al carrito
                    carrito.push({
                        idProducto: idProducto,
                        idSucursal: idSucursal,
                        ultimoPrecioVenta: ultimoPrecioVenta,
                        cantidad: cantidad,
                        nombreProducto: nombreProducto,
                        UrlProducto: UrlProducto
                    });

                    // Mostrar mensaje de éxito al agregar el producto
                    const mensajeExito = document.getElementById('mensaje-exito');
                    mensajeExito.style.display = 'block';

                    // Ocultar el mensaje después de 3 segundos
                    setTimeout(() => {
                        mensajeExito.style.display = 'none';
                    }, 3000);

                } else {
                    // Actualizar la cantidad del producto en el carrito
                    carrito[index].cantidad += cantidad;

                    // Mostrar mensaje de actualización de cantidad
                    const mensajeActualizado = document.getElementById('mensaje-actualizado');
                    mensajeActualizado.style.display = 'block';

                    // Ocultar el mensaje después de 3 segundos
                    setTimeout(() => {
                        mensajeActualizado.style.display = 'none';
                    }, 3000);
                }

                // Guardar el carrito actualizado en el localStorage
                localStorage.setItem('carrito', JSON.stringify(carrito));

                // Actualizar el contador del carrito
                actualizarContadorCarrito();
            });
        });
    </script>
@endsection
