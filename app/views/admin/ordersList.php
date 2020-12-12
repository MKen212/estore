<!-- Orders List - ADMIN -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Orders</h2>
</div>

<div class="row">
  <!-- Orders Table Search -->
  <div class="col-4 mb-3">
    <form action="" method="post" name="schOrders">
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
  <div class="col-6"><?php
    msgShow(); ?>
  </div>
</div>

<div class="row">
  <!-- Orders Table List -->
  <div class="table-responsive">
    <table class="table table-striped table-sm tableScrollable">
      <thead>
        <tr>
          <th style="width: 8%"><br />Invoice ID</th>
          <th style="width: 5%"><br />Items</th>
          <th style="width: 8%"><br />Products</th>
          <th style="width: 7%">Ship<br />Country</th>
          <th style="width: 7%">Ship<br />Type</th>
          <th style="width: 7%">Value<br />(<?= DEFAULTS["currency"] ?>)</th>
          <th style="width: 12%"><br />Payment Status</th>
          <th style="width: 14%"><br />Name</th>
          <th style="width: 19%"><br />Date/Time Added</th>
          <th style="width: 7%">Order<br />Status</th>
          <th style="width: 6%">Record<br />Status</th>
        </tr>
      </thead>
      <tbody><?php
        if (empty($orderList)) :  // No Order Records Found ?>
          <tr>
            <td colspan="11">No Orders to Display</td>
          </tr><?php
        else :
          foreach ($orderList as $record) : ?>
            <tr><!-- Order Record -->
              <td style="width: 8%"><a href="admin_dashboard.php?p=orderDetails&id=<?= $record["OrderID"] ?>"><?= $record["InvoiceID"] ?></a></td>
              <td style="width: 5%"><?= $record["ItemCount"] ?></td>
              <td style="width: 8%"><?= $record["ProductCount"] ?></td>
              <td style="width: 7%"><?= $record["ShippingCountry"];?></td>
              <td style="width: 7%"><?= $record["ShippingType"] ?></td>
              <td style="width: 7%"><?= $record["Total"] ?></td>
              <td style="width: 12%"><?= $record["PaymentStatus"] ?></td>
              <td style="width: 14%"><?= $record["PayerName"] ?></td>
              <td style="width: 19%"><?= date("d/m/Y @ H:i", strtotime($record["AddedTimestamp"])) . " by " . $record["OwnerUserID"] ?></td>
              <td style="width: 7%"><?= statusOutput("OrderStatus", $record["OrderStatus"]) ?></td>
              <td style="width: 6%"><?= statusOutput("Status", $record["Status"]) ?></td>
            </tr><?php
          endforeach;
        endif; ?>
      </tbody>
    </table>
  </div>
</div>