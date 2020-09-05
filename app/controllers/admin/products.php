<!-- Admin Dashboard - Products List/Edit -->
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
  </div>
</div>

<div class="row">
  <!-- Products Table List -->
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <!-- Products Table Header -->
        <th>Image</th>
        <th>Product ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Category</th>
        <th>Price (<?= DEFAULTS["currency"]; ?>)</th>
        <th>Weight (Grams)</th>
        <th>Quantity</th>
        <th>Last Edit</th>
        <th>On Sale</th>
        <th>Status</th>
      </thead>
      <tbody>
        <?php
        include_once "../app/models/productClass.php";
        $product = new Product();

        if (isset($_POST["productSearch"])) {
          $name = fixSearch($_POST["schProduct"]);
          $_POST = [];
          foreach(new RecursiveArrayIterator($user->getListByEmail($email)) as $record) {
            include "../app/views/admin/productListItem.php";
          }
        } else {
          foreach(new RecursiveArrayIterator($user->getList()) as $record) {
            include "../app/views/admin/productListItem.php";
          }
        }
        ?>      
      </tbody>
    </table>
  </div>
</div>