<?php  // Admin Dashboard - Shipping Rates List/Edit
if (isset($_GET["updStatus"])) {  // Status link was clicked
  $shippingID = $_GET["id"];
  $current = $_GET["cur"];
  $_GET=[];
  $newStatus = statusCycle("Status", $current);
  // Update Shipping Status
  include_once "../app/models/shippingClass.php";
  $shipping = new Shipping();
  $updateStatus = $shipping->updateStatus($shippingID, $newStatus);
}
?>

<!-- Main Section - Shipping Rates List -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Shipping Rates</h2>
</div>

<div class="row">
  <!-- Shipping Table Search -->
  <div class="col-4 mb-3">
    <form action="" method="POST" name="schShipping">
      <!-- Search -->
      <div class="input-group">
        <input class="form-control" type="text" name="schBandOrType" placeholder="Search Band or Type" autocomplete="off" />
        <div class="input-group-append">
          <button class="btn btn-secondary" type="submit" name="shippingSearch"><span data-feather="search"></span></button>
        </div>
      </div>
    </form>
  </div>
  <div class="col-2">
    <!-- New Shipping Rate Button -->
    <div class="input-group">
      <a class="btn btn-primary" href="admin_dashboard.php?p=shippingAdd">Add New Rate</a>
    </div>
  </div>
  <div class="col-6">
    <!-- System Messages -->
    <?php msgShow(); ?>
  </div>
</div>

<div class="row">
  <!-- Shipping Table List -->
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <!-- Shipping Table Header -->
        <th>ID</th>
        <th>Reference</th>
        <th>Band</th>
        <th>Type</th>
        <th>Band Weight<br />(Kg)</th>
        <th>Price<br />(<?= DEFAULTS["currency"]; ?>)</th>
        <th>Last Edit</th>
        <th>Status</th>
      </thead>
      <tbody>
        <?php
        if (isset($_POST["shippingSearch"])) {
          $search = fixSearch($_POST["schBandOrType"]);
          $_POST = [];
        } else {
          $search = null;
        }
        include_once "../app/models/shippingClass.php";
        $shipping = new Shipping();
        foreach(new RecursiveArrayIterator($shipping->getList($search)) as $record) {
          $record["ShippingRef"] = substr($record["Band"], 0, 3) . "-" . substr($record["Type"], 0, 3) . "-" . $record["PriceBandKG"];  // Shipping Ref Field
          include "../app/views/admin/shippingListItem.php";
        }
        ?>      
      </tbody>
    </table>
  </div>
</div>