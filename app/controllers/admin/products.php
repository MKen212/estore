<?php  // Admin Dashboard - Products List/Edit
if (isset($_GET["updStatus"])) {  // Check if Status was clicked
  $productID = $_GET["id"];
  $current = $_GET["cur"];
  $max = count(STATUS_CODES["Status"]) - 1;
  $_GET=[];

  $newStatus = $current + 1;
  if ($newStatus > $max) $newStatus = 0;

  // Update Product Status
  include_once "../app/models/productClass.php";
  $product = new Product();
  $updateStatus = $product->updateStatus($productID, $newStatus);
} elseif (isset($_GET["updFlag"])) {  // Check if Flag was clicked
  $productID = $_GET["id"];
  $current = $_GET["cur"];
  $max = count(STATUS_CODES["Flag"]) - 1;
  $_GET=[];

  $newStatus = $current + 1;
  if ($newStatus > $max) $newStatus = 0;

  // Update Product Flag
  include_once "../app/models/productClass.php";
  $product = new Product();
  $updateStatus = $product->updateFlag($productID, $newStatus);
}
?>

<!-- Main Section - Products List -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Products</h2>
</div>

<div class="row">
  <!-- Products Table Search -->
  <div class="col-4 mb-3">
    <form action="" method="POST" name="schProducts">
      <!-- Search -->
      <div class="input-group">
        <input class="form-control" type="text" name="schProduct" placeholder="Search Product Name" autocomplete="off" />
        <div class="input-group-append">
          <button class="btn btn-secondary" type="submit" name="productSearch"><span data-feather="search"></span></button>
        </div>
      </div>
    </form>
  </div>
  <div class="col-2">
    <!-- New Product Button -->
    <div class="input-group">
      <a class="btn btn-primary" href="admin_dashboard.php?p=productAdd">Add New Product</a>
    </div>
  </div>
  <div class="col-6">
    <!-- System Messages -->
    <?php msgShow(); ?>
  </div>
</div>

<div class="row">
  <!-- Products Table List -->
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <!-- Products Table Header -->
        <th>ID</th>
        <th>Name</th>
        <th>Category</th>
        <th>Brand</th>
        <th>Price<br />(<?= DEFAULTS["currency"]; ?>)</th>
        <th>Weight<br />(Grams)</th>
        <th>Quantity</th>
        <th>Last Edit</th>
        <th>Flag</th>
        <th>Status</th>
      </thead>
      <tbody>
        <?php
        if (isset($_POST["productSearch"])) {
          $name = fixSearch($_POST["schProduct"]);
          $_POST = [];
        } else {
          $name = null;
        }
        include_once "../app/models/productClass.php";
        $product = new Product();
        foreach(new RecursiveArrayIterator($product->getList($name)) as $record) {
          include "../app/views/admin/productListItem.php";
        }
        ?>      
      </tbody>
    </table>
  </div>
</div>