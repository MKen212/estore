<div class="col-sm-4"><!--Product Item-->
  <div class="product-image-wrapper">
    <div class="single-products">
      <div class="productinfo text-center">
        <img width="270" height="250" src="<?= $record["FullPath"] ?>" alt="<?= $record["ImgFilename"]; ?>" />
        <h2><?= symValue($record["Price"]); ?></h2>
        <p><?= $record["Name"]; ?></p>
      </div>
      <div class="product-overlay">
        <div class="overlay-content">
          <h2><?= symValue($record["Price"]); ?></h2>
          <p><?= $record["Name"]; ?></p>
          <a href="index.php?p=productDetails&id=<?= $record["ProductID"]; ?>" class="btn btn-default add-to-cart"><i class="fa fa-info-circle"></i>View Details</a>
        </div>
      </div>
      <?php if ($record["Flag"] == 1) : ?>
        <img src="images/shop/new.png" class="new" alt="" />
      <?php elseif ($record["Flag"] == 2) : ?>
        <img src="images/shop/sale.png" class="sale" alt="" />
      <?php endif; ?>
    </div>
    <div class="choose">
      <ul class="nav nav-pills nav-justified">
        <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
        <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
      </ul>
    </div>
  </div>
</div><!--/Product Item-->