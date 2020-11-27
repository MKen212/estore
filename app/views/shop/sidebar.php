<!-- Shop Sidebar -->
<div class="left-sidebar">
  <h2>Sort By</h2>
  <div class="panel-group category-products"><!--sort-panel--><?php
    isset($_SESSION["prodSortID"]) ? prodSortFilter($_SESSION["prodSortID"]) : prodSortFilter(0); ?>
  </div><!--/sort-panel-->

  <h2>Category</h2>
  <div class="panel-group category-products"><!--category-panel--><?php
    isset($_SESSION["prodCatID"]) ? prodCatFilter($_SESSION["prodCatID"]) : prodCatFilter(0); ?>
  </div><!--/category-panel-->

  <h2>Brand</h2>
  <div class="panel-group category-products"><!--brands-panel--><?php
    isset($_SESSION["prodBrandID"]) ? prodBrandFilter($_SESSION["prodBrandID"]) : prodBrandFilter(0); ?>
  </div><!--/brands-panel-->
</div>