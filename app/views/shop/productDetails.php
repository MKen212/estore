<div class="product-details"><!--Product Details-->
  <div class="col-sm-5">
    <div class="view-product"> <!-- Main Image -->
      <img width="270" height="250" src="<?= $record["FullPath"] ?>" alt="<?= $record["ImgFilename"]; ?>" />
    </div>
  </div>

  <div class="col-sm-7">
    <div class="product-information"><!--/product-information--><?php
      if ($record["Flag"] == 1) : ?>
        <img src="images/shop/new.png" class="new" alt="" /><?php
      elseif ($record["Flag"] == 2) : ?>
        <img src="images/shop/sale.png" class="sale" alt="" /><?php
      endif; ?>
      <h2><?= $record["Name"]; ?></h2>
      <textarea rows="3" readonly><?= fixCRLF($record["Description"]); ?></textarea>
      <!-- Removed Ratings as hard-coded image
      <img src="images/product-details/rating.png" alt="" />
      -->
      
      <form action="" method="POST" name="prodATCForm"><!-- Add To Cart Form -->
        <span>
          <span><?= symValue($record["Price"]); ?></span>
          <label>Quantity:</label>
          <input type="number" name="qtyOrdered" value="<?= $quantity;?>" min="<?= $quantity;?>" max="<?= $record["QtyAvail"]; ?>" />
          <button type="submit" name="addProdToCart" class="btn btn-default add-to-cart" style="margin-bottom:6px"<?= ($record["QtyAvail"] <= 0) ? " disabled" : null;?>><i class="fa fa-shopping-cart"></i>Add to cart</button>
        </span>
      </form>

      <p><b>Product ID: </b><?= $selectedID; ?></p>
      <p><b>Availability: </b><?= ($record["QtyAvail"] > 0) ? $record["QtyAvail"] . " In Stock" : "OUT OF STOCK";?></p>
      <p><b>Category: </b><?= $record["Category"]; ?></p>
      <p><b>Brand: </b><?= $record["Brand"]; ?></p>
      <p><b>Weight: </b><?= $record["WeightGrams"]; ?> grams</p>
      
    </div><!--/product-information-->
  </div>
</div><!--/Product Details-->