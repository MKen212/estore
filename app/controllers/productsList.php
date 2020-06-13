<?php  // List all Products in card format
include_once("../models/productClass.php");
$product = new Product();

// Loop through ALL Books and output the values
foreach (new RecursiveArrayIterator($product->getProductsActive()) as $value) {
  $fullPath = DEFAULTS["productsImgPath"] . $value["ProductID"] . "/" . $value["ImgFilename"];
?>
  <div class="col-sm-4"><!--Featured Item-->
    <div class="product-image-wrapper">
      <div class="single-products">
        <div class="productinfo text-center">
          <img src="<?php echo $fullPath; ?>" alt="<?php echo $value["ImgFilename"]; ?>" />
          <h2>CHF<?php echo $value["PriceCHF"]; ?></h2>
          <p><?php echo $value["Name"]; ?></p>
          <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
        </div>
        <div class="product-overlay">
          <div class="overlay-content">
            <h2>CHF<?php echo $value["PriceCHF"]; ?></h2>
            <p><?php echo $value["Name"]; ?></p>
            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
          </div>
        </div>
      </div>
      <div class="choose">
        <ul class="nav nav-pills nav-justified">
          <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
          <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
        </ul>
      </div>
    </div>
  </div><!--/Featured Item-->
<?php
}?>

<!-- UP TO HERE - RELOAD DATABASE & FIX IMAGE SIZE & MAYBE CURRENCY?? -->