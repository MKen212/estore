<!-- Checkout Summary -->
<section id="do_action"><!--do_action-->
  <div class="row">
    <div class="col-sm-6">
      <form class="chose_area" action="index.php?p=checkout#ship" method="POST" name="shippingForm">
        <h5 style="margin-left:30px;">Current Shipment Weight: <?= $_SESSION["cart"][0]["shippingWeightKG"]; ?> KG - NO additional charges over 10KG!!</h5>

        <ul class="user_info">
          <li class="single_field">
            <label>Shipping Band:</label>
            <select>
              <option selected><?= $_SESSION["cart"][0]["shippingBand"]; ?></option>
            </select>
          </li>
          <li class="single_field">
            <label>Shipping Priority:</label>
            <select id="shippingPriority" name="updatedShipValue" onchange="updateShipCost()">
              <?php foreach ($shippingCosts as $value) {
                if ($value["Type"] == $_SESSION["cart"][0]["shippingType"]) {
                  echo "<option value='" . $value["PriceBandCost"] . "' selected>" . $value["Type"] . "</option>";
                } else {
                  echo "<option value='" . $value["PriceBandCost"] . "'>" . $value["Type"] . "</option>";
                }
              } ?>
            </select>
          </li>
          <li class="single_field zip-field">
            <label>Shipping Cost:</label>
            <input type="text" id="shippingCost" value="<?= $_SESSION["cart"][0]["shippingCost"]; ?>" readonly />
          </li>
        </ul>
        <button class="btn btn-default update" type="submit" name="updateShipping">Update</button>
      </form>
    </div>
    <div class="col-sm-6">
      <div class="total_area">
        <ul>
          <li>Cart Sub Total <span><?= symValue($_SESSION["cart"][0]["subTotal"]); ?></span></li>
          <li>Shipping Cost <span><?= symValue($_SESSION["cart"][0]["shippingCost"]); ?></span></li>
          <li>TOTAL <span><?= symValue($_SESSION["cart"][0]["total"]); ?></span></li>
        </ul>
          <a class="btn btn-default check_out" href="">Check Out</a>
      </div>
    </div>
  </div>
</section><!--/do_action-->