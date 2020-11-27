<!-- Products List - ADMIN -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Products</h2>
</div>

<div class="row">
  <!-- Products Table Search -->
  <div class="col-4 mb-3">
    <form action="" method="POST" name="schProducts">
      <div class="input-group">
        <input class="form-control" type="text" name="schProduct" placeholder="Search Product Name" autocomplete="off" />
        <div class="input-group-append">
          <button class="btn btn-secondary" type="submit" name="productSearch"><span data-feather="search"></span></button>
        </div>
      </div>
    </form>
  </div>
  <!-- New Product Button -->
  <div class="col-2">
    <div class="input-group">
      <a class="btn btn-primary" href="admin_dashboard.php?p=productAdd">Add New Product</a>
    </div>
  </div>
  <!-- System Messages -->
  <div class="col-6"><?php
    msgShow(); ?>
  </div>
</div>

<div class="row">
  <!-- Products Table List -->
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Category</th>
          <th>Brand</th>
          <th>Price<br />(<?= DEFAULTS["currency"]; ?>)</th>
          <th>Weight<br />(Grams)</th>
          <th>Qty</th>
          <th>Last Edit</th>
          <th>Flag</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody><?php
        foreach($productList as $record) : ?>
          <tr><!-- Product Record -->
            <td><?= $record["ProductID"]; ?></td>
            <td><a href="admin_dashboard.php?p=productDetails&id=<?= $record["ProductID"]; ?>"><?= $record["Name"]; ?></a></td>
            <td><?= $record["Category"]; ?></td>
            <td><?= $record["Brand"]; ?></td>
            <td><?= $record["Price"]; ?></td>
            <td><?= $record["WeightGrams"]; ?></td>
            <td><?= $record["QtyAvail"]; ?></td>
            <td><?= date("d/m/Y @ H:i", strtotime($record["EditTimestamp"])) . " by " . $record["EditUserID"]; ?></td>
            <td><?= statusOutput("Flag", $record["Flag"], ("admin_dashboard.php?p=products&id=" . $record["ProductID"] . "&cur=" . $record["Flag"] . "&updFlag")); ?></td>
            <td><?= statusOutput("Status", $record["Status"], ("admin_dashboard.php?p=products&id=" . $record["ProductID"] . "&cur=" . $record["Status"] . "&updStatus")); ?></td>
          </tr><?php
        endforeach; ?>      
      </tbody>
    </table>
  </div>
</div>