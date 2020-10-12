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
        <th>Returns Ref</th>
        <th>Invoice ID</th>
        <th>Items</th>
        <th>Products</th>
        <th>Value<br />(<?= DEFAULTS["currency"] ?>)</th>
        <th>Date/Time Added</th>
        <th>Return<br />Status</th>
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
        include_once "../app/models/returnsClass.php";
        $returns = new Returns();
        foreach(new RecursiveArrayIterator($returns->getList($invoiceID)) as $record) {
          $record["ReturnsRef"] = $record["InvoiceID"] . "-RTN-" . $record["ReturnID"];  // Returns Ref Field
          include "../app/views/admin/returnsListItem.php";
        }
        ?>      
      </tbody>
    </table>
  </div>
</div>