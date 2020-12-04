<!-- Shipping Details Form - ADMIN -->
<div class="row pt-3 pb-2 mb-3 border-bottom">
  <div class="col-6">
    <h2><?= $formData["formTitle"] ?></h2>
  </div>
  <!-- System Messages -->
  <div class="col-6"><?php
    msgShow(); ?>
  </div>
</div><?php

if (empty($shippingRecord)) :  // Shipping Record not found ?>
  <div>Shipping ID not found.</div><?php
else :  // Display Shipping Form ?>
  <form class="ml-3" action="" method="post" name="shippingForm" autocomplete="off">
    <!-- Band -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="band">Band:</label>
      <div class="inpFixed">
        <select class="form-control" name="band" id="band" required><?php
          shipBandOptions($shippingRecord["Band"]); ?>
        </select>
      </div>
    </div>
    <!-- Type -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="type">Type:</label>
      <div class="inpFixed">
        <select class="form-control" name="type" id="type" required><?php
          shipTypeOptions($shippingRecord["Type"]); ?>
        </select>
      </div>
    </div>
    <!-- PriceBandKG -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="priceBandKG">Band Weight (Kg):</label>
      <div class="inpFixed">
        <input class="form-control" type="number" name="priceBandKG" id="priceBandKG" placeholder="Enter Band Weight in Kilograms" min="0" value="<?= $shippingRecord["PriceBandKG"] ?>" required />
      </div>
    </div>
    <!-- PriceBandCost -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="priceBandCost">Price (<?= DEFAULTS["currency"] ?>):</label>
      <div class="inpFixed">
        <input class="form-control" type="number" name="priceBandCost" id="priceBandCost" placeholder="Enter Price in <?= DEFAULTS["currency"] ?>" min="0" step="0.01" value="<?= $shippingRecord["PriceBandCost"] ?>" required />
      </div>
    </div>
    <!-- Status -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="status">Status:</label>
      <div class="inpFixed">
        <select class="form-control" name="status" id="status" required><?php
          statusOptions("Status", $shippingRecord["Status"]); ?>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <!-- Submit Button -->
      <div class="col-form-label labFixed">
        <button class="btn btn-primary" type="submit" name="<?= $formData["subName"] ?>"><?= $formData["subText"] ?></button>
      </div>
      <!-- Results -->
      <div class="inpFixed" id="shippingFormResult"><?php
        msgShow(); ?>
      </div>
    </div>
  </form><?php
endif; ?>