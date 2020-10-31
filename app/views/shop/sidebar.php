<!-- Shop Sidebar -->
<div class="left-sidebar">
  <h2>Category</h2>
  <div class="panel-group category-products" id="accordian"><!--category-panel-->
    <?php isset($_SESSION["prodCatID"]) ? prodCatFilter($_SESSION["prodCatID"]) : prodCatFilter(0); ?>
  </div><!--/category-panel-->

  <h2>Brands</h2>
  <div class="panel-group category-products" id="accordian"><!--brands-panel-->
    <?php isset($_SESSION["prodBrandID"]) ? prodBrandFilter($_SESSION["prodBrandID"]) : prodBrandFilter(0); ?>
  </div><!--/brands-panel-->
</div>
