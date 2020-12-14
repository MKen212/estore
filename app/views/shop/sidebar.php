<!-- Shop Sidebar -->
<div class="left-sidebar">
  <h2>Sort By</h2>
  <div class="panel-group category-products"><!--sort_panel-->
    <div class="panel panel-default">
      <div class="panel-heading"><?php
      // Output all PROD_SORT_OPTIONS as HTML links
      foreach (PROD_SORT_OPTIONS as $key => $value) :
        if ($key == 0) continue;  // Do not output default sort option
        if ($key == $prodSortID) : ?>
          <h4 class="panel-title"><a class="active" href="index.php?p=products&sp=1&sort=<?= $key ?>"><?= $value["text"] ?></a><a class="actClear" href="index.php?p=products&sp=1&sort=0"><i class="fa fa-trash-o"></i></a></h4><?php
        else : ?>
          <h4 class="panel-title"><a href="index.php?p=products&sp=1&sort=<?= $key ?>"><?= $value["text"] ?></a></h4><?php
        endif;
      endforeach; ?>
      </div>
    </div>
  </div><!--/sort_panel-->

  <h2>Category</h2>
  <div class="panel-group category-products"><!--category-panel-->
    <div class="panel panel-default">
      <div class="panel-heading"><?php
      // Output all ACTIVE Names from prod_categories as HTML links
      foreach ($prodCatData as $value) :
        if ($value["ProdCatID"] == $prodCatID) : ?>
          <h4 class="panel-title"><a class="active" href="index.php?p=products&sp=1&cat=<?= $value["ProdCatID"] ?>"><?= $value["Name"] ?></a><a class="actClear" href="index.php?p=products&sp=1&cat=0"><i class="fa fa-trash-o"></i></a></h4><?php
        else : ?>
          <h4 class="panel-title"><a href="index.php?p=products&sp=1&cat=<?= $value["ProdCatID"] ?>"><?= $value["Name"] ?></a></h4><?php
        endif;
      endforeach; ?>
      </div>
    </div>
  </div><!--/category-panel-->

  <h2>Brand</h2>
  <div class="panel-group category-products"><!--brands-panel-->
    <div class="panel panel-default">
      <div class="panel-heading"><?php
      // Output all ACTIVE Names from prod_brands as HTML links
      foreach ($prodBrandData as $value) :
        if ($value["ProdBrandID"] == $prodBrandID) : ?>
          <h4 class="panel-title"><a class="active" href="index.php?p=products&sp=1&brand=<?= $value["ProdBrandID"] ?>"><?= $value["Name"] ?></a><a class="actClear" href="index.php?p=products&sp=1&brand=0"><i class="fa fa-trash-o"></i></a></h4><?php
        else : ?>
          <h4 class="panel-title"><a href="index.php?p=products&sp=1&brand=<?= $value["ProdBrandID"] ?>"><?= $value["Name"] ?></a></h4><?php
        endif;
      endforeach; ?>
      </div>
    </div>
  </div><!--/brands-panel-->
</div>