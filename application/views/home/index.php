<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Ejemplo de compra con mercado pago</h1>
  <div class="btn-toolbar mb-2 mb-md-0"></div>
</div>
<section class="shopping-cart dark">
	<div class="container" id="container">
		<div class="block-heading"><h2>Comprar <?php echo $o->title; ?></h2></div>
		<div class="content">
            <div class="row">
              <div class="col-md-12 col-lg-8">
                <div class="items">
                  <div class="product">
                    <div class="info">
                      <div class="product-details">
                        <div class="row justify-content-md-center">
                          <div class="col-md-12 product-detail">
                            <h5>Plan</h5>
                            <div class="product-info">
                              <p><b></b><span id="product-description"><?php echo $o->title; ?></span><br>
                              <b>Costo:</b> $ <span id="unit-price"><?php echo $o->price; ?></span></p>
                            </div>
                          </div>
                          <div class="col-md-3 product-detail d-none">
                            <label for="quantity"><h5>Cantidad</h5></label>
                            <input type="number" id="quantity" value="1" class="form-control">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-lg-4">
                <div class="summary">
					<h3>Costo del plan</h3>
					<div class="summary-item"><span class="text">Subtotal</span><span class="price" id="cart-total"></span></div>
					<a class="btn btn-primary btn-lg btn-block" href="<?php echo $preference->init_point; ?>">Pagar con Mercado Pago</a>
					<!--<script src="https://www.mercadopago.com.co/integrations/v1/web-payment-checkout.js" data-preference-id="<?php echo $preference->id; ?>"></script>-->
					<button class="btn btn-primary btn-lg btn-block d-none" id="checkout-btn">Confirmar</button>
                </div>
              </div>
            </div>
		</div>
	</div>
</section>