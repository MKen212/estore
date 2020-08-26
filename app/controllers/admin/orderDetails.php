<?php  // Main Section - Admin Order Details
if (!isset($_GET["id"])) :  // Check Invoice ID Provided ?>
  <div>No Invoice ID provided.</div>
<?php else : ?>
  <!-- Main Section - Admin Order Info -->
  <div class="pt-3 pb-2 mb-3 border-bottom">
    <h2>Order Details - Invoice ID: <?= $_GET["id"] ?></h2>
  </div>

  <?php
  include_once "../app/models/orderClass.php";
  $order = new Order();

  // Get Order Details
  $orderDetails = $order->getDetails($_GET["id"]);
  // Update Status Code to Text
  $orderDetails["Status"] = ordStatusText($orderDetails["Status"]);
  // Update Shipping Instructions if none
  if (empty($orderDetails["ShippingInstructions"])) $orderDetails["ShippingInstructions"] = "-None-";

  // Show Details in Order Header
  include "../app/views/admin/orderHeader.php";

  // Show Order Items
  ?>
  <div class="row"><!--order_items-->
    <div class="col-sm-12">
      <h5>Ordered Items</h5>
      <div class="table-responsive">
        <table class="table table-sm" style="margin-bottom:50px">
          <thead>
            <tr>
              <th>Item ID</th>
              <th>Product ID</th>
              <th>Description</th>
              <th>Unit Price</th>
              <th>Quantity</th>
              <th>Item Status</th>
            </tr>
          </thead>
          <tbody>
            <?php  // Loop through Order Items and output a row per item
            $orderID = $orderDetails["OrderID"];
            foreach (new RecursiveArrayIterator($order->getItems($orderID)) as $record) {
              include "../app/views/admin/orderItem.php";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div><!--/order_items-->
<?php endif; ?>
