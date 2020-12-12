<!-- My Orders List - SHOP -->
<section id="cart_items">
  <div class="container">
    <!-- Title Block -->
    <div class="row">
      <div class="col-sm-12 bg">
        <h2 class="title text-center">My Orders</h2>
      </div>
    </div>

    <div class="row"><?php
      if (!isset($_SESSION["userLogin"])) :  // Check User is Logged In ?>
        <div class="register-req">
          <p>Please <a href="index.php?p=login">Login (or Signup)</a> to proceed.</p>
        </div><?php
      else :  // Display Order List ?>
        <!-- Orders List - SHOP -->
        <div class="table-responsive" style="margin-bottom:75px">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>Invoice ID</th>
                <th>Items</th>
                <th>Products</th>
                <th>Date/Time Added</th>
                <th>Value</th>
                <th>Payment Status</th>          
                <th>Order Status</th>
              </tr>
            </thead>
            <tbody><?php              
              if (empty($orderList)) :  // No Order Records Found ?>
                <tr>
                  <td colspan="7">No Orders to Display</td>
                </tr><?php
              else :
                foreach ($orderList as $record) : ?>
                  <tr><!-- Order Record -->
                    <td><a href="index.php?p=orderDetails&id=<?= $record["OrderID"] ?>"><?= $record["InvoiceID"] ?></a></td>
                    <td><?= $record["ItemCount"] ?></td>
                    <td><?= $record["ProductCount"] ?></td>
                    <td><?= date("d/m/Y @ H:i", strtotime($record["AddedTimestamp"])) ?></td>
                    <td><?= symValue($record["Total"]) ?></td>
                    <td><?= $record["PaymentStatus"] ?></td>
                    <td><?= statusOutputShop("OrderStatus", $record["OrderStatus"]) ?></td>
                  </tr><?php
                endforeach;
              endif; ?>
            </tbody>
          </table>
        </div><?php
      endif; ?>
    </div>
  </div>
</section>