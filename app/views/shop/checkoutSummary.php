<!-- Checkout Summary -->
<div class="review-payment" id="ship">
  <h2>Review Shipping</h2>
</div>
<section id="do_action"><!--do_action-->
  <div class="row">
    <div class="col-sm-6">
      <form class="chose_area" action="index.php?p=checkout#ship" method="POST" name="shippingForm">
        <h5 style="margin-left:30px;">Current Shipment Weight: <?= $_SESSION["cart"][0]["ShippingWeightKG"]; ?> KG - NO additional charges over 10KG!!</h5>

        <ul class="user_info">
          <li class="single_field">
            <label>Shipping Band:</label>
            <select>
              <option selected><?= $_SESSION["cart"][0]["ShippingBand"]; ?></option>
            </select>
          </li>
          <li class="single_field">
            <label>Shipping Priority:</label>
            <select id="shippingPriority" name="updatedShipValue" onchange="updateShipCost()">
              <?php foreach ($shippingCosts as $value) {
                if ($value["Type"] == $_SESSION["cart"][0]["ShippingType"]) {
                  echo "<option value='" . $value["PriceBandCost"] . "' selected>" . $value["Type"] . "</option>";
                } else {
                  echo "<option value='" . $value["PriceBandCost"] . "'>" . $value["Type"] . "</option>";
                }
              } ?>
            </select>
          </li>
          <li class="single_field zip-field">
            <label>Shipping Cost:</label>
            <input type="text" id="shippingCost" value="<?= $_SESSION["cart"][0]["ShippingCost"]; ?>" readonly />
          </li>
        </ul>
        <button class="btn btn-default update" type="submit" name="updateShipping">Update</button>
      </form>
    </div>
    <div class="col-sm-6">
      <form class="total_area" action="index.php?p=checkout#pay" method="POST" name="checkoutForm">
        <ul>
          <li>Cart Sub Total <span><?= symValue($_SESSION["cart"][0]["SubTotal"]); ?></span></li>
          <li>Shipping Cost <span><?= symValue($_SESSION["cart"][0]["ShippingCost"]); ?></span></li>
          <li>TOTAL <span><?= symValue($_SESSION["cart"][0]["Total"]); ?></span></li>
        </ul>
        <button class="btn btn-default update" type="submit" name="processPayment">Make Payment</button>
      </form>
    </div>
  </div>
</section><!--/do_action-->