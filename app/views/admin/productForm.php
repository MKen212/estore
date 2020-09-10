<!-- Product Form -->
<form class="ml-3" action="" enctype="multipart/form-data" method="POST" name="productForm" autocomplete="off">
  <div class="row">
    <div class="col-6">
      <!-- Name -->
      <div class="form-group row">
        <label class="col-form-label labFixed" for="name">Name:</label>
        <div class="inpFixed">
          <input class="form-control" type="text" name="name" id="name" placeholder="Enter Product Name" value="<?= $productData["Name"]; ?>" required autofocus />
        </div>
      </div>
      <!-- Description -->
      <div class="form-group row">
        <label class="col-form-label labFixed" for="description">Description:</label>
        <div class="inpFixed">
          <textarea class="form-control taFixed" name="description" id="description" rows="3" placeholder="Enter Product Description" maxlength="500" required><?= $productData["Description"]; ?></textarea>
        </div>
      </div>
      <!-- Product Category ID -->
      <div class="form-group row">
        <label class="col-form-label labFixed" for="prodCatID">Category:</label>
        <select class="form-control inpFixed" name="prodCatID" id="prodCatID" required>
          <?php prodCatOptions($productData["ProdCatID"]); ?>
        </select>
      </div>
      <!-- Price -->
      <div class="form-group row">
        <label class="col-form-label labFixed" for="price">Price (<?= DEFAULTS["currency"]; ?>):</label>
        <div class="inpFixed">
          <input class="form-control" type="number" name="price" id="price" placeholder="Enter Price in <?= DEFAULTS["currency"]; ?>" min="0" step="0.01" value="<?= $productData["Price"]; ?>" required />
        </div>
      </div>
      <!-- Weight in Grams -->
      <div class="form-group row">
        <label class="col-form-label labFixed" for="weightGrams">Weight (Grams):</label>
        <div class="inpFixed">
          <input class="form-control" type="number" name="weightGrams" id="weightGrams" placeholder="Enter Shipping Weight in Grams" min="0" value="<?= $productData["WeightGrams"]; ?>" required />
        </div>
      </div>
      <!-- Quantity Available -->
      <div class="form-group row">
        <label class="col-form-label labFixed" for="qtyAvail">Quantity Available:</label>
        <div class="inpFixed">
          <input class="form-control" type="number" name="qtyAvail" id="qtyAvail" placeholder="Enter Quantity Available" min="0" value="<?= $productData["QtyAvail"]; ?>" required />
        </div>
      </div>
      <!-- IsNew -->
      <div class="form-group row">
        <label class="col-form-label labFixed" for="isNew">New:</label>
        <div class="inpFixed">
          <select class="form-control" name="isNew" id="isNew" required>
            <?php statusOptions("IsNew", $productData["IsNew"]); ?>
          </select>
        </div>
      </div>
      <!-- IsOnSale -->
      <div class="form-group row">
        <label class="col-form-label labFixed" for="isOnSale">On Sale:</label>
        <div class="inpFixed">
          <select class="form-control" name="isOnSale" id="isOnSale" required>
            <?php statusOptions("IsOnSale", $productData["IsOnSale"]); ?>
          </select>
        </div>
      </div>
      <!-- Status -->
      <div class="form-group row">
        <label class="col-form-label labFixed" for="status">Status:</label>
        <div class="inpFixed">
          <select class="form-control" name="status" id="status" required>
            <?php statusOptions("Status", $productData["Status"]); ?>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <!-- Submit Button -->
        <div class="col-form-label labFixed">
          <button class="btn btn-primary" type="submit" name="<?= $formData["subName"]; ?>"><?= $formData["subText"]; ?></button>
        </div>
        <!-- Results -->
        <div class="inpFixed" id="productFormRes">
          <?php msgShow(); ?>
        </div>
      </div>
    </div>
    <div class="col-6">
      <!-- Image Filename -->
      <div class="form-group row">
        <label class="col-form-label labFixed">Product Image:</label>
        <div class="custom-file inpFixed">
          <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo DEFAULTS['maxUploadSize'];?>" />
          <label class="custom-file-label" for="imgFilename">Choose file</label>
          <input class="custom-file-input" type="file" name="imgFilename" id="imgFilename" />
        </div>
      </div>
      <?php if (!empty($fullPath)) : ?>
        <!-- Current Image (if Editing) -->
        <div class="form-group row">
          <label class="col-form-label labFixed" for="image">Current Image:</label>
          <img width="270" height="250" id="image" src="<?= $fullPath; ?>" alt="<?= $productData["ImgFilename"]; ?>" />
        </div>
      <?php endif ; ?>
    </div>
  </div>
</form>
