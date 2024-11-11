 @extends('templateHeader')

 @section('content')
     <!--================Checkout Area =================-->
     <section class="checkout_area padding_top">
         <div class="container">
             <div class="returning_customer">
                 <div class="check_title">
                     <h2>
                         Tienes una cuenta?
                         <a href="#">Click aqui para iniciar sesion</a>
                     </h2>
                 </div>
                 <p style="margin-bottom: 40px">
                     Sino tienes una cuenta, debes ingresar tus datos para proceder a la compra
                 </p>

                 <div class="billing_details">
                     <div class="row">
                         <div class="col-lg-8">

                             <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                                 <h2 style="margin-bottom: 25px">Datos del cliente</h2>
                                 <div class="col-md-6 form-group p_star">
                                     <h6>Nombres</h6>
                                     <input type="text" name="Nombres" style="width: 50%;" placeholder="Nombres"
                                         onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nombres'" required
                                         class="single-input">
                                 </div>
                                 <div class="col-md-6 form-group p_star">
                                     <h6>Apellidos</h6>
                                     <input type="text" name="Apellidos" style="width: 50%;" placeholder="Apellidos"
                                         onfocus="this.placeholder = ''" onblur="this.placeholder = 'Apellidos'" required
                                         class="single-input">
                                 </div>
                                 <div class="col-md-6 form-group p_star">
                                     <h6>Telefono</h6>
                                     <input type="number" name="Telefono" style="width: 50%;" placeholder="Telefono"
                                         onfocus="this.placeholder = ''" onblur="this.placeholder = 'Telefono'" required
                                         class="single-input">
                                 </div>
                                 <div class="col-md-6 form-group p_star">
                                     <h6>Correo</h6>
                                     <input type="number" name="Correo" style="width: 50%;" placeholder="Correo"
                                         onfocus="this.placeholder = ''" onblur="this.placeholder = 'Correo'" required
                                         class="single-input">
                                 </div>
                                 <div class="col-md-6 form-group p_star">
                                     <h6>Nit</h6>
                                     <input type="number" name="Nit" style="width: 50%;" placeholder="Nit"
                                         onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nit'" required
                                         class="single-input">
                                 </div>
                                 <h2 style="margin-bottom: 20px">Datos de dirección</h2>
                                 <div class="col-md-6 form-group p_star">
                                     <h6>Direccion</h6>
                                     <input type="text" name="Direccion" style="width: 50%;" placeholder="Direccion"
                                         onfocus="this.placeholder = ''" onblur="this.placeholder = 'Direccion'" required
                                         class="single-input">
                                 </div>
                                 <div class="col-md-12 form-group p_star">
                                     <h6>Departamento</h6>
                                     <input type="text" name="Departamento" style="width: 50%;"
                                         placeholder="Departamento" onfocus="this.placeholder = ''"
                                         onblur="this.placeholder = 'Departamento'" required class="single-input">
                                 </div>
                                 <div class="col-md-12 form-group p_star">
                                     <h6>Municipio</h6>
                                     <input type="text" name="Municipio" style="width: 50%;" placeholder="Municipio"
                                         onfocus="this.placeholder = ''" onblur="this.placeholder = 'Municipio'" required
                                         class="single-input">
                                 </div>
                                 <div class="col-md-12 form-group">
                                     <h6>Codigo postal</h6>
                                     <input type="text" name="CodigoPostal" style="width: 50%;"
                                         placeholder="Codigo postal" onfocus="this.placeholder = ''"
                                         onblur="this.placeholder = 'Codigo postal'" required class="single-input">
                                 </div>
                                 <div class="col-md-12 form-group">
                                     <div class="creat_account">
                                         <input type="checkbox" id="f-option2" name="selector" />
                                         <label for="f-option2">Crear cuenta?</label>
                                     </div>
                                 </div>
                             </form>

                             <a class="btn_3" href="#">Cancelar pedido</a>
                         </div>
                         <div class="col-lg-4">
                             <div class="order_box">
                                 <h2>Your Order</h2>
                                 <ul class="list">
                                     <li>
                                         <a href="#">Product
                                             <span>Total</span>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="#">Fresh Blackberry
                                             <span class="middle">x 02</span>
                                             <span class="last">$720.00</span>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="#">Fresh Tomatoes
                                             <span class="middle">x 02</span>
                                             <span class="last">$720.00</span>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="#">Fresh Brocoli
                                             <span class="middle">x 02</span>
                                             <span class="last">$720.00</span>
                                         </a>
                                     </li>
                                 </ul>
                                 <ul class="list list_2">
                                     <li>
                                         <a href="#">Subtotal
                                             <span>$2160.00</span>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="#">Shipping
                                             <span>Flat rate: $50.00</span>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="#">Total
                                             <span>$2210.00</span>
                                         </a>
                                     </li>
                                 </ul>
                                 <div class="payment_item">
                                     <div class="radion_btn">
                                         <input type="radio" id="f-option5" name="selector" />
                                         <label for="f-option5">Deposito </label>
                                         <div class="check"></div>
                                     </div>
                                     <p>
                                         Deposita al numero de cuenta que se te enviara por correo y debes de responder con
                                         el comprobante de pago
                                     </p>
                                 </div>
                                 <div class="payment_item active">
                                     <div class="radion_btn">
                                         <input type="radio" id="f-option6" name="selector" />
                                         <label for="f-option6">Tarjeta </label>
                                         <img src="img/product/single-product/card.jpg" alt="" />
                                         <div class="check"></div>
                                     </div>
                                     <p>
                                         Por favor, ingresa tu tarjeta para poder realizar el cobro
                                     </p>
                                 </div>

                                 <a class="btn_2" href="#">Terminar compra</a>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
     </section>
     <!--================End Checkout Area =================-->
 @endsection
