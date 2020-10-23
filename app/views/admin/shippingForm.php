<!-- Shipping Form -->
<div>
  <form class="ml-3" action="" method="POST" name="shippingForm" autocomplete="off">
    <!-- Band -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="band">Band:</label>
      <div class="inpFixed">
        <select class="form-control" name="band" id="band" required>
          <?php shipBandOptions($shippingData["Band"]); ?>
        </select>
      </div>
    </div>
    <!-- Type -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="type">Type:</label>
      <div class="inpFixed">
        <select class="form-control" name="type" id="type" required>
          <?php shipTypeOptions($shippingData["Type"]); ?>
        </select>
      </div>
    </div>
    <!-- PriceBandKG -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="priceBandKG">Band Weight (Kg):</label>
      <div class="inpFixed">
        <input class="form-control" type="number" name="priceBandKG" id="priceBandKG" placeholder="Enter Band Weight in Kilograms" min="0" value="<?= $shippingData["PriceBandKG"]; ?>" required />
      </div>
    </div>
    <!-- PriceBandCost -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="priceBandCost">Price (<?= DEFAULTS["currency"]; ?>):</label>
      <div class="inpFixed">
        <input class="form-control" type="number" name="priceBandCost" id="priceBandCost" placeholder="Enter Price in <?= DEFAULTS["currency"]; ?>" min="0" step="0.01" value="<?= $shippingData["PriceBandCost"]; ?>" required />
      </div>
    </div>
    <!-- Status -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="status">Status:</label>
      <div class="inpFixed">
        <select class="form-control" name="status" id="status" required>
          <?php statusOptions("Status", $shippingData["Status"]); ?>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <!-- Submit Button -->
      <div class="col-form-label labFixed">
        <button class="btn btn-primary" type="submit" name="<?= $formData["subName"]; ?>"><?= $formData["subText"]; ?></button>
      </div>
      <!-- Results -->
      <div class="inpFixed" id="shippingFormResult">
        <?php msgShow(); ?>
      </div>
    </div>
  </form>
</div>