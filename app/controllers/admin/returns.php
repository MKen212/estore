<?php  // Admin Dashboard - Returns List/Edit

?>

<!-- Main Section - Returns List -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Returns</h2>
</div>

<div class="row">
  <!-- Returns Table Search -->
  <div class="col-4 mb-3">
    <form action="" method="POST" name="schReturns">
      <!-- Search -->
      <div class="input-group">
        <input class="form-control" type="text" name="schReturn" placeholder="Search Invoice ID" autocomplete="off" />
        <div class="input-group-append">
          <button class="btn btn-secondary" type="submit" name="returnSearch"><span data-feather="search"></span></button>
        </div>
      </div>
    </form>
  </div>
  <div class="col-2">
    <!-- New Return Button ** NOT REQUIRED ** -->
  </div>
  <div class="col-6">
    <!-- System Messages -->
    <?php msgShow(); ?>
  </div>
</div>

<!-- Returns Table List -->
<div class="row">
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <!-- Returns Table Header -->
        <th>Invoice ID</th>
        <th>Items</th>
        <th>Products</th>
        <th>Ship<br />Country</th>
        <th>Ship<br />Type</th>
        <th>Value<br />(<?= DEFAULTS["currency"] ?>)</th>
        <th>Payment Status</th>
        <th>Name</th>
        <th>Date/Time Added</th>
        <th>Order<br />Status</th>
        <th>Record<br />Status</th>
      </thead>
      <tbody>
        <?php
        if (isset($_POST["returnSearch"])) {
          $invoiceID = fixSearch($_POST["schReturn"]);
          $_POST=[];
        } else {
          $invoiceID = null;
        }
        //include_once "../app/models/orderClass.php";
        //$order = new Order();
        //foreach(new RecursiveArrayIterator($order->getList($invoiceID)) as $record) {
        //  include "../app/views/admin/orderListItem.php";
        //}
        ?>      
      </tbody>
    </table>
  </div>
</div>