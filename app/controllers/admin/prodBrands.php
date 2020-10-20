<?php  // Admin Dashboard - ProdBrands List/Edit
if (isset($_GET["updStatus"])) {  // Status link was clicked
  $prodBrandID = $_GET["id"];
  $current = $_GET["cur"];
  $_GET=[];
  $newStatus = statusCycle("Status", $current);
  // Update ProdBrand Status
  include_once "../app/models/prodBrandClass.php";
  $prodBrand = new ProdBrand();
  $updateStatus = $prodBrand->updateStatus($prodBrandID, $newStatus);
}
?>

<!-- Main Section - Product Brand List -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Product Brands</h2>
</div>

<div class="row">
  <!-- ProdBrands Table Search -->
  <div class="col-4 mb-3">
    <form action="" method="POST" name="schProdBrands">
      <!-- Search -->
      <div class="input-group">
        <input class="form-control" type="text" name="schName" placeholder="Search Name" autocomplete="off" />
        <div class="input-group-append">
          <button class="btn btn-secondary" type="submit" name="prodBrandSearch"><span data-feather="search"></span></button>
        </div>
      </div>
    </form>
  </div>
  <div class="col-2">
    <!-- New Product Brand Button -->
    <div class="input-group">
      <a class="btn btn-primary" href="admin_dashboard.php?p=prodBrandAdd">Add New Brand</a>
    </div>
  </div>
  <div class="col-6">
    <!-- System Messages -->
    <?php msgShow(); ?>
  </div>
</div>

<div class="row">
  <!-- ProdBrand Table List -->
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <!-- ProdBrand Table Header -->
        <th>ID</th>
        <th>Name</th>
        <th>Last Edit</th>
        <th>Status</th>
      </thead>
      <tbody>
        <?php
        if (isset($_POST["prodBrandSearch"])) {
          $name = fixSearch($_POST["schName"]);
          $_POST = [];
        } else {
          $name = null;
        }
        include_once "../app/models/prodBrandClass.php";
        $prodBrand = new ProdBrand();
        foreach(new RecursiveArrayIterator($prodBrand->getList($name)) as $record) {
          include "../app/views/admin/prodBrandListItem.php";
        }
        ?>      
      </tbody>
    </table>
  </div>
</div>
