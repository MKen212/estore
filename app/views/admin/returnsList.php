<!-- Returns List - ADMIN -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Returns</h2>
</div>

<div class="row">
  <!-- Returns Table Search -->
  <div class="col-4 mb-3">
    <form action="" method="post" name="schReturns">
      <div class="input-group">
        <input class="form-control" type="text" name="schReturn" placeholder="Search Invoice ID" autocomplete="off" />
        <div class="input-group-append">
          <button class="btn btn-secondary" type="submit" name="returnSearch"><span data-feather="search"></span></button>
        </div>
      </div>
    </form>
  </div>
  <!-- New Return Button -->
  <div class="col-2">
    <!-- ** NOT REQUIRED - Returns should only be added in Shop ** -->
  </div>
  <!-- System Messages -->
  <div class="col-6"><?php
    msgShow(); ?>
  </div>
</div>

<div class="row">
  <!-- Returns Table List -->
  <div class="table-responsive">
    <table class="table table-striped table-sm tableScrollable">
      <thead>
        <tr>
          <th style="width: 15%"><br />Return Ref</th>
          <th style="width: 12%"><br />Invoice ID</th>
          <th style="width: 7%"><br />Items</th>
          <th style="width: 11%"><br />Products</th>
          <th style="width: 9%">Value<br />(<?= DEFAULTS["currency"] ?>)</th>
          <th style="width: 26%"><br />Date/Time Added</th>
          <th style="width: 11%">Return<br />Status</th>
          <th style="width: 9%">Record<br />Status</th>
        </tr>
      </thead>
      <tbody><?php
        foreach($returnsList as $record) : ?>
          <tr><!-- Returns Record -->
            <td style="width: 15%"><a href="admin_dashboard.php?p=returnDetails&id=<?= $record["ReturnID"] ?>"><?= returnRef($record["InvoiceID"], $record["ReturnID"]) ?></a></td>
            <td style="width: 12%"><?= $record["InvoiceID"] ?></td>
            <td style="width: 7%"><?= $record["ItemCount"] ?></td>
            <td style="width: 11%"><?= $record["ProductCount"] ?></td>
            <td style="width: 9%"><?= $record["RefundTotal"] ?></td>
            <td style="width: 26%"><?= date("d/m/Y @ H:i", strtotime($record["AddedTimestamp"])) . " by " . $record["OwnerUserID"] ?></td>
            <td style="width: 11%"><?= statusOutput("ReturnStatus", $record["ReturnStatus"]) ?></td>
            <td style="width: 9%"><?= statusOutput("Status", $record["Status"]) ?></td>
          </tr><?php
        endforeach; ?>      
      </tbody>
    </table>
  </div>
</div>