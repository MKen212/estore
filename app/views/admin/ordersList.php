<!-- Orders List - ADMIN -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Orders</h2>
</div>

<div class="row">
  <!-- Orders Table Search -->
  <div class="col-4 mb-3">
    <form action="" method="POST" name="schOrders">
      <div class="input-group">
        <input class="form-control" type="text" name="schOrder" placeholder="Search Invoice ID" autocomplete="off" />
        <div class="input-group-append">
          <button class="btn btn-secondary" type="submit" name="orderSearch"><span data-feather="search"></span></button>
        </div>
      </div>
    </form>
  </div>
  <!-- New Product Button -->
  <div class="col-2">
    <!-- ** NOT REQUIRED - Orders should only added in Shop ** -->
  </div>
  <!-- System Messages -->
  <div class="col-6">
    <?php msgShow(); ?>
  </div>
</div>

<div class="row">
  <!-- Orders Table List -->
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
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
        <?php foreach($orderList as $record) : ?>
          <tr><!-- Order Record -->
            <td><a href="admin_dashboard.php?p=orderDetails&id=<?= $record["OrderID"]; ?>"><?= $record["InvoiceID"]; ?></a></td>
            <td><?= $record["ItemCount"]; ?></td>
            <td><?= $record["ProductCount"]; ?></td>
            <td><?= $record["ShippingCountry"]; ?></td>
            <td><?= $record["ShippingType"]; ?></td>
            <td><?= $record["Total"]; ?></td>
            <td><?= $record["PaymentStatus"]; ?></td>
            <td><?= $record["PayerName"]; ?></td>
            <td><?= date("d/m/Y @ H:i", strtotime($record["AddedTimestamp"])) . " by " . $record["OwnerUserID"]; ?></td>
            <td><?= statusOutput("OrderStatus", $record["OrderStatus"]); ?></td>
            <td><?= statusOutput("Status", $record["Status"]); ?></td>
          </tr>
        <?php endforeach; ?>      
      </tbody>
    </table>
  </div>
</div>