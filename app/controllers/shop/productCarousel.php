<?php  // Shop - Product New & On Sale Carousel
include_once "../app/models/productClass.php";
$product = new Product();
?>

<div class="recommended_items"><!--recommended_items-->
  <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel" data-interval="8000">
    <div class="carousel-inner">
      <div class="item active">
        <h2 class="title text-center">New Products</h2>
        <?php  // Loop through NEW products and output 3 random records
        foreach (new RecursiveArrayIterator($product->getCarousel(3, 1)) as $record) {
          $record["FullPath"] = getFilePath($record["ProductID"], $record["ImgFilename"]);
          include "../app/views/shop/productItem.php";
        }?>
      </div>
      <div class="item">
        <h2 class="title text-center">On Sale</h2>
        <?php  // Loop through SALE products and output 3 random records
        foreach (new RecursiveArrayIterator($product->getCarousel(3, 2)) as $record) {
          $record["FullPath"] = getFilePath($record["ProductID"], $record["ImgFilename"]);
          include "../app/views/shop/productItem.php";
        }?>
      </div>
    </div>
    <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev"><i class="fa fa-angle-left"></i></a>
    <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next"><i class="fa fa-angle-right"></i></a>
  </div>
</div><!--/recommended_items-->