<!-- Products Form -->
<div>
  <form class="ml-3" action="" enctype="multipart/form-data" method="POST" name="productsForm">
    <!-- Name -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="name">Name:</label>
      <div class="inpFixed">
        <input class="form-control" type="text" name="name" id="name" placeholder="Enter Product Name" autocomplete="off" required autofocus />
      </div>
    </div>
    <!-- Description -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="description">Description:</label>
      <div class="inpFixed">
        <textarea class="form-control taFixed" name="description" id="description" rows="4" placeholder="Enter Product Description" maxlength="500" autocomplete="off" required></textarea>
      </div>
    </div>
    <!-- Category -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="category">Category:</label>
      <select class="form-control inpFixed" name="category" id="category">
        <option value="clothesMen">Mens Clothes</option>
        <option value="clothesWomen">Womens Clothes</option>
        <option value="shoesMen">Mens Shoes</option>
        <option value="shoesWomen">Womens Shoes</option>
      </select>
    </div><!-- Price Local -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="priceLocal">Price (<?= DEFAULTS["localCurrency"] ?>):</label>
      <div class="inpFixed">
        <input class="form-control" type="number" name="priceLocal" id="priceLocal" placeholder="Enter Price in <?= DEFAULTS["localCurrency"]; ?>" min="0" step="0.01" value="0.00" autocomplete="off" required />
      </div>
    </div>
    <!-- Quantity -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="quantity">Quantity:</label>
      <div class="inpFixed">
        <input class="form-control" type="number" name="quantity" id="quantity" placeholder="Enter Initial Quantity" min="1" value="1" autocomplete="off" required />
      </div>
    </div>
    <!-- Image Filename -->
    <div class="form-group row">
      <label class="col-form-label labFixed">Product Image:</label>
      <div class="custom-file inpFixed">
        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo DEFAULTS['maxUploadSize'];?>" />
        <input class="custom-file-input" type="file" name="imgFilename" id="imgFilename" />
        <label class="custom-file-label" for="imgFilename">Choose file</label>
      </div>
    </div>
    <div class="form-group row">
      <!-- Submit Button -->
      <div class="col-form-label labFixed">
        <button class="btn btn-primary" type="submit" name="addProduct">Add Product</button>
      </div>
      <!-- Results -->
      <div class="inpFixed" id="productAddRes">
      </div>
    </div>
  </form>
</div>
