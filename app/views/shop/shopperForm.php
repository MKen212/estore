<!-- Shopper Information Form -->
<div class="shopper-info"><!--shopper_information-->
  <form class="row" action="" method="POST" name="shopperForm" autocomplete="off">
    <div class="col-sm-8 clearfix">
      <div class="bill-to">
        <div class="form-one"><!--billing_information-->
          <p>Bill To</p>
          <input type="text" name="billFullName" value="<?= $userData["fullName"]; ?>" placeholder="Full Name" required />
          <input type="text" name="billAddress1" value="<?= $userData["Address1"]; ?>" placeholder="Address 1" required />
          <input type="text" name="billAddress2" value="<?= $userData["Address2"]; ?>" placeholder="Address 2" />
          <input type="text" name="billCity" value="<?= $userData["City"]; ?>" placeholder="Town/City" required />
          <input type="text" name="billRegion" value="<?= $userData["Region"]; ?>" placeholder="State/Province/Region" />
          <select name="billCountryCode" required>
            <?php countryOptions($userData["CountryCode"]); ?>
          </select>
          <input type="text" name="billPostcode" value="<?= $userData["Postcode"]; ?>" placeholder="Postcode" required />
          <input type="email" name="billEmail" value="<?= $userData["Email"]; ?>" placeholder="Email" required />
          <input type="tel" name="billContact" value="<?= $userData["ContactNo"]; ?>" placeholder="Contact Telephone" />
        </div><!--/billing_information-->
        <div class="form-two"><!--shipping_information-->
          <p>Ship To</p>
          <input type="text" name="shipFullName" placeholder="Full Name" required />
          <input type="text" name="shipAddress1" placeholder="Address 1" required />
          <input type="text" name="shipAddress2" placeholder="Address 2" />
          <input type="text" name="shipCity" placeholder="Town/City" required />
          <input type="text" name="shipRegion" placeholder="State/Province/Region" />
          <select name="shipCountryCode" required>
            <?php countryOptions("CH"); ?>
          </select>
          <input type="text" name="shipPostcode" placeholder="Postcode" required />
          <input type="email" name="shipEmail" placeholder="Email" required />
          <input type="tel" name="shipContact" placeholder="Contact Telephone" />
        </div><!--/shipping_information-->
      </div>
    </div>
    <div class="col-sm-4">
      <div class="order-message"><!--shipping_instructions-->
        <p>Shipping Instructions</p>
        <textarea name="shipInstructions" placeholder="Notes about your order, Special Notes for Delivery" maxlength="500"></textarea>
        <a class="btn btn-primary" href="">Copy Bill To > Ship To</a>
        <button class="btn btn-primary" type="submit" name="placeOrder">Order</button>
      </div><!--/shipping_instructions-->
    </div>
  </form>
</div><!--/shopper_information-->