<!-- Country Form -->
<div>
  <form class="ml-3" action="" method="POST" name="countryForm" autocomplete="off">
    <!-- Code -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="code">Country Code:</label>
      <div class="inpFixed">
        <input class="form-control" type="text" name="code" id="code" maxlength="2" pattern="[A-Z]{2}" placeholder="Enter Country Code (2 Capital Letters)" value="<?= $countryData["Code"]; ?>" required />
      </div>
    </div>
    <!-- Name -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="name">Name:</label>
      <div class="inpFixed">
        <input class="form-control" type="text" name="name" id="name" placeholder="Enter Name" value="<?= $countryData["Name"]; ?>" required />
      </div>
    </div>
    <!-- ShippingBand -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="shippingBand">Shipping Band:</label>
      <div class="inpFixed">
        <select class="form-control" name="shippingBand" id="shippingBand" required><?php
          shipBandOptions($countryData["ShippingBand"]); ?>
        </select>
      </div>
    </div>
    <!-- Status -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="status">Status:</label>
      <div class="inpFixed">
        <select class="form-control" name="status" id="status" required><?php
          statusOptions("Status", $countryData["Status"]); ?>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <!-- Submit Button -->
      <div class="col-form-label labFixed">
        <button class="btn btn-primary" type="submit" name="<?= $formData["subName"]; ?>"><?= $formData["subText"]; ?></button>
      </div>
      <!-- Results -->
      <div class="inpFixed" id="countryFormResult"><?php
        msgShow(); ?>
      </div>
    </div>
  </form>
</div>