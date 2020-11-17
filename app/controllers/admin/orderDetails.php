<?php  // Admin Dashboard - Order Details
if (!isset($_GET["id"])) $_GET["id"] = "0";  // Set OrderID to 0 if not provided
$orderID = cleanInput($_GET["id"], "int");

// Process Status Changes if hyperlinks selected
if (isset($_GET["updStatus"])) {  // Record Status Link was clicked
  $current = $_GET["cur"];
  // $_GET=[];
  $newStatus = statusCycle("Status", $current);
  // Update Order Status
  include_once "../app/models/orderClass.php";
  $order = new Order();
  $updateStatus = $order->updateStatus($orderID, $newStatus);
} elseif (isset($_GET["updOrderStatus"])) {  // Order Status Link was clicked
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
$_GET = [];

// Process OrderItem Updates if Update Order POSTed
if (isset($_POST["updateOrder"])){
  include_once "../app/models/orderItemClass.php";
  $orderItem = new OrderItem();
  $update = 0;
  foreach ($_POST["ordItems"] as $key => $value) {
    if (empty($value["shippedDate"])) $value["shippedDate"] = "0000-00-00";
    $update += $orderItem->updateShippedDate($key, $value["shippedDate"]);
  }
  $_POST=[];
  if ($update > 0) $_SESSION["message"] = msgPrep("success", "Order updated successfully.<br />");
}
?>
<!-- Main Section - Admin Order Info -->
<div class="row pt-3 pb-2 mb-3 border-bottom">
  <div class="col-6">
    <h2>Order Details - ID: <?= $orderID ?></h2>
  </div>
  <div class="col-6">
    <!-- System Messages -->
    <?php msgShow(); ?>
  </div>
</div>

<?php
// Get Order Details
include_once "../app/models/orderClass.php";
$order = new Order();
$orderDetails = $order->getDetails($orderID);

if ($orderDetails == false) :  // OrderID not found ?>
  <div>Order ID not found.</div>
<?php else :
  // Update Shipping Instructions if none
  if (empty($orderDetails["ShippingInstructions"])) $orderDetails["ShippingInstructions"] = "- None -";

  // Show Details in Order Header
  include "../app/views/admin/orderHeader.php";

  // Show Order Items
  ?>
  <div class="row" id="orderItems"><!--order_items-->
    <div class="col-sm-12">
      <h5>Ordered Items</h5>
      <div class="table-responsive">
        <form action="admin_dashboard.php?p=orderDetails&id=<?= $orderID; ?>" method="POST" name="ordItemsForm" autocomplete="off">
          <table class="table table-striped table-sm" style="margin-bottom:50px">
            <thead>
              <tr>
                <th>Item</th>
                <th>Image</th>
                <th>Product Details</th>
                <th>Unit Price</th>
                <th>Qty</th>
                <th>Qty Avail<br />For Return</th>
                <th style="border-left:double">Date Shipped<br />Last Edit</th>
                <th>Shipped<br />Item Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include_once "../app/models/orderItemClass.php";
              $orderItem = new OrderItem();
              // Loop through Order Items and output a row per item
              foreach (new RecursiveArrayIterator($orderItem->getItemsByOrder($orderID)) as $record) {
                $record["FullPath"] = getFilePath($record["ProductID"], $record["ImgFilename"]);
                include "../app/views/admin/orderItem.php";
              }
              ?>
              <tr>
                <td colspan="6"></td>
                <td colspan="2" style="border-left:double">
                  <button class="btn btn-primary" style="margin-top:10px" type="submit" name="updateOrder">Update Order</button>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div><!--/order_items-->
<?php endif; ?>