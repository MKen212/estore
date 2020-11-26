<!-- Returns List - ADMIN -->
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
    <!-- New Return Button ** NOT REQUIRED - Returns only added in Shop ** -->
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
        <?php foreach($returnsList as $record) : ?>
          <tr><!--returns_list_item_ADMIN-->
            <td><a href="admin_dashboard.php?p=returnDetails&id=<?= $record["ReturnID"]; ?>"><?= returnsRef($record["InvoiceID"], $record["ReturnID"]); ?></a></td>
            <td><?= $record["InvoiceID"]; ?></td>
            <td><?= $record["ItemCount"]; ?></td>
            <td><?= $record["ProductCount"]; ?></td>
            <td><?= $record["RefundTotal"]; ?></td>
            <td><?= date("d/m/Y @ H:i", strtotime($record["AddedTimestamp"])) . " by " . $record["OwnerUserID"]; ?></td>
            <td><?= statusOutput("ReturnStatus", $record["ReturnStatus"]); ?></td>
            <td><?= statusOutput("Status", $record["Status"]); ?></td>
          </tr><!--/returns_list_item_ADMIN-->
        <?php endforeach; ?>      
      </tbody>
    </table>
  </div>
</div>