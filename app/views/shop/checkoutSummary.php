<!-- Checkout Summary -->
<section id="ship"><!--ship-->
  <div class="row">
    <div class="col-sm-8 clearfix">
      <form class="bill-to" action="index.php?p=checkout#ship" method="POST" name="shippingForm">
        <div class="form-one order-message"><!--shipping_instructions-->
          <h2>Shipping Instructions</h2>
          <textarea name="shipInstructions" placeholder="Notes about your order, Special Notes for Delivery" maxlength="500"><?= $_SESSION["cart"][0]["shippingInstructions"] ?></textarea>
        </div><!--/shipping_instructions-->
        <div class="form-two"><!--shipping_costs-->
          <h2 style="padding-left: 40px">Shipping Details</h2>
          <ul class="user_info">
            <li>Current shipment weight is: <?= $_SESSION["cart"][0]["shippingWeightKG"]; ?> KG.<br /><b>NO</b> additional charges on shipments over 10KG!!</li>
            <br />
            <li class="single_field">
              <label>"Ship To" Country:</label>
              <select name="shipToCountry" required>
                <?php countryOptions($_SESSION["cart"][0]["shippingCountry"]); ?>
              </select>
            </li>
            <li class="single_field">
              <label>Shipping Priority:</label>
              <select name="shippingPriority">
                <?php shippingOptions("Type", $_SESSION["cart"][0]["shippingType"]); ?>
              </select>
            </li>
            <li>
              <button class="btn btn-default update" type="submit" name="updateShipping">Update All & Continue</button>
            </li>
          </ul>
        </div><!--/shipping_costs-->
      </form>
    </div>

    <div class="col-sm-4" id="pay"><!--totals-->
      <?php if (isset($_POST["updateShipping"])) : ?>
      <form class="total_area" action="index.php?p=checkout#pay" method="POST" name="checkoutForm">
        <h2>Payment Summary</h2>
        <ul>
          <li>Cart Sub Total <span><?= symValue($_SESSION["cart"][0]["subTotal"]); ?></span></li>
          <li>Shipping Cost <span><?= symValue($_SESSION["cart"][0]["shippingCost"]); ?></span></li>
          <li>TOTAL <span><?= symValue($_SESSION["cart"][0]["total"]); ?></span></li>
        </ul>
        <div id="paypal-button-container"></div>
        <div id="paypal-processing" style="padding-left: 40px"></div>
      </form>
      <?php endif; ?>
    </div><!--/totals-->
  </div>
</section><!--/ship-->