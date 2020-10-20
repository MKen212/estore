<?php  // Admin Dashboard - ProdCats List/Edit
if (isset($_GET["updStatus"])) {  // Status link was clicked
  $prodCatID = $_GET["id"];
  $current = $_GET["cur"];
  $_GET=[];
  $newStatus = statusCycle("Status", $current);
  // Update ProdCat Status
  include_once "../app/models/prodCatClass.php";
  $prodCat = new ProdCat();
  $updateStatus = $prodCat->updateStatus($prodCatID, $newStatus);
}
?>

<!-- Main Section - Product Category List -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Product Categories</h2>
</div>

<div class="row">
  <!-- ProdCats Table Search -->
  <div class="col-4 mb-3">
    <form action="" method="POST" name="schProdCats">
      <!-- Search -->
      <div class="input-group">
        <input class="form-control" type="text" name="schName" placeholder="Search Name" autocomplete="off" />
        <div class="input-group-append">
          <button class="btn btn-secondary" type="submit" name="prodCatSearch"><span data-feather="search"></span></button>
        </div>
      </div>
    </form>
  </div>
  <div class="col-2">
    <!-- New Product Category Button -->
    <div class="input-group">
      <a class="btn btn-primary" href="admin_dashboard.php?p=prodCatAdd">Add New Category</a>
    </div>
  </div>
  <div class="col-6">
    <!-- System Messages -->
    <?php msgShow(); ?>
  </div>
</div>

<div class="row">
  <!-- ProdCat Table List -->
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <!-- ProdCat Table Header -->
        <th>ID</th>
        <th>Name</th>
        <th>Last Edit</th>
        <th>Status</th>
      </thead>
      <tbody>
        <?php
        if (isset($_POST["prodCatSearch"])) {
          $name = fixSearch($_POST["schName"]);
          $_POST = [];
        } else {
          $name = null;
        }
        include_once "../app/models/prodCatClass.php";
        $prodCat = new ProdCat();
        foreach(new RecursiveArrayIterator($prodCat->getList($name)) as $record) {
          include "../app/views/admin/prodCatListItem.php";
        }
        ?>      
      </tbody>
    </table>
  </div>
</div>