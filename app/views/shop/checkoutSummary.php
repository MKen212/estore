<!-- Checkout Summary - SHOP -->
<section id="cart_items">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 bg">
        <h2 class="title text-center">Checkout</h2>
      </div>
    </div>
    
    <div class="row"><?php
      // Check Cart has Items
      if (!isset($_SESSION["cart"][0])) :?>
        <div class="register-req">
          <p>Your Shopping Cart is currently empty. Please visit our <a href="index.php?p=products">Shop</a> to proceed.</p>
        </div><?php
      elseif (!isset($_SESSION["userLogin"])) :  // Check User is Logged In ?>
        <div class="register-req">
          <p>Please <a href="index.php?p=login&r=checkout">Login (or Signup)</a> to proceed.</p>
        </div><?php
      else :  // Display Cart List ?>
        <div class="review-payment" id="order">
          <h2>Review Order</h2>
        </div><?php
        // NOTE: Potentially validate Cart against stock at this point?
        include "../app/views/shop/cartList.php"; ?>

        <!-- Checkout Summary -->
        <div class="row">
          <div class="col-sm-8 clearfix" id="ship">
            <form class="bill-to" action="index.php?p=checkout#ship" method="post" name="shippingForm">
              <!-- Shipping Instructions -->
              <div class="form-one order-message">
                <h5>Shipping Instructions</h5>
                <textarea name="shipInstructions" maxlength="500" placeholder="Enter any notes about your order, or special instructions regarding delivery"><?= fixCRLF($_SESSION["cart"][0]["shippingInstructions"]) ?></textarea>
              </div>
              <!-- Shipping Details -->
              <div class="form-two">
                <h5 style="padding-left: 40px">Shipping Details</h5>
                <ul class="user_info">
                  <li>Current shipment weight is: <?= $_SESSION["cart"][0]["shippingWeightKG"] ?> KG.<br /><b>NO</b> additional charges on shipments over 10KG!!</li>
                  <br />
                  <li class="single_field">
                    <label>"Ship To" Country:</label>
                    <select name="shipToCountry" required><?php
                      countryOptions($_SESSION["cart"][0]["shippingCountry"]); ?>
                    </select>
                  </li>
                  <li class="single_field">
                    <label>Shipping Priority:</label>
                    <select name="shippingPriority"><?php
                      shipTypeOptions($_SESSION["cart"][0]["shippingType"]); ?>
                    </select>
                  </li>
                  <li>
                    <button class="btn btn-default update" type="submit" name="updateShipping">Update All & Continue</button>
                  </li>
                </ul>
              </div>
            </form>
          </div>

          <!-- Totals & PayPal Buttons -->
          <div class="col-sm-4" id="pay"><?php
            if ($renderPayPalButtons == true) : ?>
              <form class="total_area" action="index.php?p=checkout#pay" method="post" name="checkoutForm">
                <h5>Payment Summary</h5>
                <ul>
                  <li>Cart Sub Total <span><?= symValue($_SESSION["cart"][0]["subTotal"]) ?></span></li>
                  <li>Shipping Cost <span><?= symValue($_SESSION["cart"][0]["shippingCost"]) ?></span></li>
                  <li>TOTAL <span><?= symValue($_SESSION["cart"][0]["total"]) ?></span></li>
                </ul>
                <div id="paypal-button-container"></div>
                <div id="paypal-processing" style="padding-left: 40px"></div>
              </form><?php
            endif; ?>
          </div>
        </div><?php 
      endif;?>
    </div>
  </div>
</section>