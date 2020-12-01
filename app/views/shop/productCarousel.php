<!-- Products Carousel - SHOP -->
<div class="recommended_items"><!--recommended_items-->
  <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel" data-interval="8000">
    <div class="carousel-inner">
      <div class="item active">
        <h2 class="title text-center">New Products</h2><?php
        // Loop through NEW products and output records
        foreach ($newProducts as $record) {
          include "../app/views/shop/productItem.php";
        } ?>
      </div>
      <div class="item">
        <h2 class="title text-center">On Sale</h2><?php
        // Loop through SALE products and output records
        foreach ($saleProducts as $record) {
          include "../app/views/shop/productItem.php";
        } ?>
      </div>
    </div>
    <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev"><i class="fa fa-angle-left"></i></a>
    <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next"><i class="fa fa-angle-right"></i></a>
  </div>
</div><!--/recommended_items-->