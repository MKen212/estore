<?php  // Admin Dashboard - Order Details
if (!isset($_GET["id"])) :  // Check Order ID Provided ?>
  <div>No Order ID provided.</div>
<?php else : 
  if (isset($_GET["updStatus"])) {  // Record Status Link was clicked
    $orderID = $_GET["id"];
    $current = $_GET["cur"];
    // $_GET=[];
    $newStatus = statusCycle("Status", $current);
    // Update Order Status
    include_once "../app/models/orderClass.php";
    $order = new Order();
    $updateStatus = $order->updateStatus($orderID, $newStatus);
  } elseif (isset($_GET["updOrderStatus"])) {  // Order Status Link was clicked
    $orderID = $_GET["id"];
    $current = $_GET["cur"];
    // $_GET=[];
    $newStatus = statusCycle("OrderStatus", $current);
    // Update OrderStatus Status
    include_once "../app/models/orderClass.php";
    $order = new Order();
    $updateStatus = $order->updateOrderStatus($orderID, $newStatus);
    // Fix Sidebar Orders Badge
    $toSendCount = $order->countOrdStat(1);  // NOTE: HardCoded based on "Paid" status in Config/$statusCodes/OrderStatus
    $toSendBadge = ($toSendCount > 0) ? " <span class='badge badge-primary'>To Send: $toSendCount</span>" : "";
    ?><script>
      document.getElementById("toSendBadge").innerHTML = "<?= $toSendBadge ?>";
    </script><?php
    } elseif (isset($_GET["updItemStatus"])) {  // Item Status Link was clicked
    $orderItemID = $_GET["itemID"];
    $current = $_GET["cur"];
    // $_GET=[];
    $newStatus = statusCycle("Status", $current);
    // Update OrderItem Status
    include_once "../app/models/orderItemClass.php";
    $orderItem = new OrderItem();
    $updateStatus = $orderItem->updateStatus($orderItemID, $newStatus);
  } elseif (isset($_GET["updItemIsShipped"])) {  // Item Shipped Link was clicked
    $orderItemID = $_GET["itemID"];
    $current = $_GET["cur"];
    // $_GET=[];
    $newStatus = statusCycle("IsShipped", $current);
    // Update OrderItem IsShipped
    include_once "../app/models/orderItemClass.php";
    $orderItem = new OrderItem();
    $updateStatus = $orderItem->updateIsShipped($orderItemID, $newStatus);
  }
  ?>
  <!-- Main Section - Admin Order Info -->
  <div class="row pt-3 pb-2 mb-3 border-bottom">
    <div class="col-6">
      <h2>Order Details - Order ID: <?= $_GET["id"] ?></h2>
    </div>
    <div class="col-6">
      <!-- System Messages -->
      <?php msgShow(); ?>
    </div>
  </div>

  <?php
  $orderID = $_GET["id"];
  $_GET = [];
  include_once "../app/models/orderClass.php";
  $order = new Order();

  // Get Order Details
  $orderDetails = $order->getDetails($orderID);
  
  // Update Shipping Instructions if none
  if (empty($orderDetails["ShippingInstructions"])) $orderDetails["ShippingInstructions"] = "- None -";

  // Show Details in Order Header
  include "../app/views/admin/orderHeader.php";

  // Show Order Items
  include_once "../app/models/orderItemClass.php";
  $orderItem = new OrderItem();
  ?>
  <div class="row"><!--order_items-->
    <div class="col-sm-12">
      <h5>Ordered Items</h5>
      <div class="table-responsive">
        <table class="table table-striped table-sm" style="margin-bottom:50px">
          <thead>
            <tr>
              <th>Item ID</th>
              <th>Product ID</th>
              <th>Image</th>
              <th>Description</th>
              <th>Unit Price (<?= DEFAULTS["currency"] ?>)</th>
              <th>Quantity</th>
              <th>Date/Time Shipped</th>
              <th>Shipped</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php  // Loop through Order Items and output a row per item
            $orderID = $orderDetails["OrderID"];
            foreach (new RecursiveArrayIterator($orderItem->getItemsByOrder($orderID)) as $record) {
              $record["FullPath"] = getFilePath($record["ProductID"], $record["ImgFilename"]);
              include "../app/views/admin/orderItem.php";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div><!--/order_items-->
<?php endif; ?>
