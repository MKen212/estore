<!-- Shop Sidebar -->
<div class="left-sidebar">
  <h2>Category</h2>
  <div class="panel-group category-products" id="accordian"><!--category-panel-->
    <?php isset($_SESSION["prodCat"]) ? prodCatFilter($_SESSION["prodCat"]) : prodCatFilter(0); ?>
  </div><!--/category-panel-->

  <h2>Brands</h2>
  <div class="panel-group category-products" id="accordian"><!--brands-panel-->
    <?php isset($_SESSION["prodBrand"]) ? prodBrandFilter($_SESSION["prodBrand"]) : prodBrandFilter(0); ?>
  </div><!--/brands-panel-->
</div>
