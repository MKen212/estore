<!-- Shipping Rates List - ADMIN -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Shipping Rates</h2>
</div>

<div class="row">
  <!-- Shipping Table Search -->
  <div class="col-4 mb-3">
    <form action="" method="post" name="schShipping">
      <div class="input-group">
        <input class="form-control" type="text" name="schBandOrType" placeholder="Search Band or Type" autocomplete="off" />
        <div class="input-group-append">
          <button class="btn btn-secondary" type="submit" name="shippingSearch"><span data-feather="search"></span></button>
        </div>
      </div>
    </form>
  </div>
  <!-- New Shipping Rate Button -->
  <div class="col-2">
    <div class="input-group">
      <a class="btn btn-primary" href="admin_dashboard.php?p=shippingAdd">Add New Rate</a>
    </div>
  </div>
  <!-- System Messages -->
  <div class="col-6"><?php
    msgShow(); ?>
  </div>
</div>

<div class="row">
  <!-- Shipping Table List -->
  <div class="table-responsive">
    <table class="table table-striped table-sm tableScrollable">
      <thead>
        <tr>
          <th style="width: 15%"><br />Reference</th>
          <th style="width: 15%"><br />Band</th>
          <th style="width: 11%"><br />Type</th>
          <th style="width: 13%">Band Weight<br />(Kg)</th>
          <th style="width: 10%">Price<br />(<?= DEFAULTS["currency"] ?>)</th>
          <th style="width: 27%"><br />Last Edit</th>
          <th style="width: 9%"><br />Status</th>
        </tr>
      </thead>
      <tbody><?php
        foreach($shippingList as $record) : ?>
          <tr><!-- Shipping Record -->
            <td style="width: 15%"><a href="admin_dashboard.php?p=shippingDetails&id=<?= $record["ShippingID"] ?>"><?= (substr($record["Band"], 0, 3) . "-" . substr($record["Type"], 0, 3) . "-" . $record["PriceBandKG"])  // Shipping Ref ?></a></td>
            <td style="width: 15%"><?= $record["Band"] ?></td>
            <td style="width: 11%"><?= $record["Type"] ?></td>
            <td style="width: 13%"><?= $record["PriceBandKG"] ?></td>
            <td style="width: 10%"><?= $record["PriceBandCost"] ?></td>
            <td style="width: 27%"><?= date("d/m/Y @ H:i", strtotime($record["EditTimestamp"])) . " by " . $record["EditUserID"] ?></td>
            <td style="width: 9%"><?= statusOutput("Status", $record["Status"], ("admin_dashboard.php?p=shipping&id=" . $record["ShippingID"] . "&cur=" . $record["Status"] . "&updStatus")) ?></td>
          </tr><?php
        endforeach; ?>
      </tbody>
    </table>
  </div>
</div>