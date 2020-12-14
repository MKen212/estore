<!-- Product Details - SHOP -->
<section>
  <div class="container">
    <!-- System Messages -->
    <div class="row"><?php
      msgShow(); ?>
    </div>

    <!-- Product Details -->
    <div class="row">
      <!-- Sidebar Sort & Category / Brand Filters -->
      <div class="col-sm-3"><?php
        include "../app/views/shop/sidebar.php";?>
      </div>
      <!-- Main Product Details Page -->
      <div class="col-sm-9 padding-right">
        <div><?php
          if (empty($productRecord)) :  // Check Product is found ?>
            <div class="register-req">
              <p>Sorry - Product ID '<?= $productID ?>' not found.</p>
            </div><?php
          elseif ($productRecord["Status"] == 0) :  // Check Product is not Inactive ?>
            <div class="register-req">
              <p>Sorry - Product ID '<?= $productID ?>' is marked as 'Inactive'.</p>
            </div><?php
          else : ?>
            <!-- Product Details -->
            <div class="product-details">
              <!-- Product Image -->
              <div class="col-sm-5">
                <div class="view-product">
                  <img width="270" height="250" src="<?= getFilePath($productRecord["ProductID"], $productRecord["ImgFilename"]) ?>" alt="<?= $productRecord["ImgFilename"] ?>" />
                </div>
              </div>

              <!-- Product Information -->
              <div class="col-sm-7">
                <div class="product-information"><?php
                  // Add New/Sale Flags if set
                  if ($productRecord["Flag"] == 1) : ?>
                    <img src="images/shop/new.png" class="new" alt="" /><?php
                  elseif ($productRecord["Flag"] == 2) : ?>
                    <img src="images/shop/sale.png" class="sale" alt="" /><?php
                  endif; ?>
                  <h2><?= $productRecord["Name"] ?></h2>
                  <textarea rows="3" readonly><?= fixCRLF($productRecord["Description"]) ?></textarea>
                  <form action="" method="post" name="prodATCForm"><!-- Add To Cart Form -->
                    <input type="hidden" name="name" value="<?= $productRecord["Name"] ?>" />
                    <input type="hidden" name="price" value="<?= $productRecord["Price"] ?>" />
                    <input type="hidden" name="weightGrams" value="<?= $productRecord["WeightGrams"] ?>" />
                    <input type="hidden" name="imgFilename" value="<?= $productRecord["ImgFilename"] ?>" />
                    <span>
                      <span><?= symValue($productRecord["Price"]) ?></span>
                      <label>Quantity:</label>
                      <input type="number" name="qtyOrdered" value="<?= $productRecord["QtyAllowed"] ?>" min="<?= $productRecord["QtyAllowed"] ?>" max="<?= $productRecord["QtyAvail"]; ?>" />
                      <button type="submit" name="addProdToCart" class="btn btn-default add-to-cart" style="margin-bottom:6px"<?= ($productRecord["QtyAllowed"] == 0) ? " disabled" : null ?>><i class="fa fa-shopping-cart"></i>Add to cart</button>
                    </span>
                  </form>
                  <p><b>Product ID: </b><?= $productID ?></p>
                  <p><b>Availability: </b><?= ($productRecord["QtyAvail"] > 0) ? $productRecord["QtyAvail"] . " In Stock" : "OUT OF STOCK" ?></p>
                  <p><b>Category: </b><?= $productRecord["Category"] ?></p>
                  <p><b>Brand: </b><?= $productRecord["Brand"] ?></p>
                  <p><b>Weight: </b><?= $productRecord["WeightGrams"] ?> grams</p>
                </div>
              </div>
            </div><?php
          endif; ?>
        </div><?php
        // Show Product New/OnSale Carousel
        if (!empty($newProducts) || !empty($saleProducts)) {
          include "../app/views/shop/productCarousel.php";
        }
        ?>
      </div>
    </div>
  </div>
</section>