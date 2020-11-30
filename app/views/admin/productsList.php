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
    <table class="table table-striped table-sm tableScrollable">
      <thead>
        <tr>
          <th style="width: 27%"><br />Name</th>
          <th style="width: 12%"><br />Category</th>
          <th style="width: 12%"><br />Brand</th>
          <th style="width: 7%">Price<br />(<?= DEFAULTS["currency"]; ?>)</th>
          <th style="width: 7%">Weight<br />(Grams)</th>
          <th style="width: 6%"><br />Qty</th>
          <th style="width: 16%"><br />Last Edit</th>
          <th style="width: 6%"><br />Flag</th>
          <th style="width: 7%"><br />Status</th>
        </tr>
      </thead>
      <tbody><?php
        foreach($productList as $record) : ?>
          <tr><!-- Product Record -->
            <td style="width: 27%"><a href="admin_dashboard.php?p=productDetails&id=<?= $record["ProductID"]; ?>"><?= $record["Name"]; ?></a></td>
            <td style="width: 12%"><?= $record["Category"]; ?></td>
            <td style="width: 12%"><?= $record["Brand"]; ?></td>
            <td style="width: 7%"><?= $record["Price"]; ?></td>
            <td style="width: 7%"><?= $record["WeightGrams"]; ?></td>
            <td style="width: 6%"><?= $record["QtyAvail"]; ?></td>
            <td style="width: 16%"><?= date("d/m/Y @ H:i", strtotime($record["EditTimestamp"])) . " by " . $record["EditUserID"]; ?></td>
            <td style="width: 6%"><?= statusOutput("Flag", $record["Flag"], ("admin_dashboard.php?p=products&id=" . $record["ProductID"] . "&cur=" . $record["Flag"] . "&updFlag")); ?></td>
            <td style="width: 7%"><?= statusOutput("Status", $record["Status"], ("admin_dashboard.php?p=products&id=" . $record["ProductID"] . "&cur=" . $record["Status"] . "&updStatus")); ?></td>
          </tr><?php
        endforeach; ?>      
      </tbody>
    </table>
  </div>
</div>