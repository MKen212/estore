<!-- Shopper Information Form -->
<div class="shopper-info"><!--shopper_information-->
  <form class="row" action="" method="POST" name="shopperForm" autocomplete="off">
    <div class="col-sm-8 clearfix">
      <div class="bill-to">
        <div class="form-one"><!--billing_information-->
          <p>Bill To</p>
          <input type="text" name="FullName" id="fullName" value="<?= postValue("FullName"); ?>" placeholder="Full Name*" required />
          <input type="text" name="Address1" id="address1" value="<?= postValue("Address1"); ?>" placeholder="Address 1*" required />
          <input type="text" name="Address2" id="address2" value="<?= postValue("Address2"); ?>" placeholder="Address 2" />
          <input type="text" name="City" id="city" value="<?= postValue("City"); ?>" placeholder="Town/City*" required />
          <input type="text" name="Region" id="region" value="<?= postValue("Region"); ?>" placeholder="State/Province/Region" />
          <select name="CountryCode" id="countryCode" required>
            <?php countryOptions(postValue("CountryCode")); ?>
          </select>
          <input type="text" name="Postcode" id="postcode" value="<?= postValue("Postcode"); ?>" placeholder="Postcode*" required />
          <input type="email" name="Email" id="email" value="<?= postValue("Email"); ?>" placeholder="Email*" required />
          <input type="tel" name="ContactNo" id="contactNo" value="<?= postValue("ContactNo"); ?>" placeholder="Contact Telephone*" />
        </div><!--/billing_information-->
        <div class="form-two"><!--shipping_information-->
          <p>Ship To</p>
          <input type="text" name="ShipFullName" id="shipFullName" value="<?= postValue("ShipFullName"); ?>" placeholder="Full Name*" required />
          <input type="text" name="ShipAddress1" id="shipAddress1" value="<?= postValue("ShipAddress1"); ?>" placeholder="Address 1*" required />
          <input type="text" name="ShipAddress2" id="shipAddress2" value="<?= postValue("ShipAddress2"); ?>" placeholder="Address 2" />
          <input type="text" name="ShipCity" id="shipCity" value="<?= postValue("ShipCity"); ?>" placeholder="Town/City*" required />
          <input type="text" name="ShipRegion" id="shipRegion" value="<?= postValue("ShipRegion"); ?>" placeholder="State/Province/Region" />
          <select name="ShipCountryCode" id="shipCountryCode" required>
            <?php countryOptions(postValue("ShipCountryCode")); ?>
          </select>
          <input type="text" name="ShipPostcode" id="shipPostcode" value="<?= postValue("ShipPostcode"); ?>" placeholder="Postcode*" required />
          <input type="email" name="ShipEmail" id="shipEmail" value="<?= postValue("ShipEmail"); ?>" placeholder="Email*" required />
          <input type="tel" name="ShipContact" id="shipContact" value="<?= postValue("ShipContact"); ?>" placeholder="Contact Telephone*" />
        </div><!--/shipping_information-->
      </div>
    </div>
    <div class="col-sm-4">
      <div class="order-message"><!--shipping_instructions-->
        <p>Shipping Instructions</p>
        <textarea name="shipInstructions" placeholder="Notes about your order, Special Notes for Delivery" maxlength="500"></textarea>
        <button class="btn btn-primary" type="button" onclick="copyBillTo()">Copy Bill To > Ship To</button>
        <button class="btn btn-primary" type="submit" name="saveShopper">Save & Continue</button>
      </div><!--/shipping_instructions-->
    </div>
  </form>
</div><!--/shopper_information-->