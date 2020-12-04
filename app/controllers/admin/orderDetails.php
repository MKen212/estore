<?php  // Admin Dashboard - Order Details
include_once "../app/models/orderClass.php";
$order = new Order();
include_once "../app/models/orderItemClass.php";
$orderItem = new OrderItem();

// Get recordID if provided and process Status changes if hyperlinks clicked
$orderID = 0;
if (isset($_GET["id"])) {
  $orderID = cleanInput($_GET["id"], "int");

  if (isset($_GET["updStatus"])) {  // Record Status Link was clicked
    $curStatus = cleanInput($_GET["cur"], "int");
    $newStatus = statusCycle("Status", $curStatus);
    // Update Order Status
    $updateStatus = $order->updateStatus($orderID, $newStatus);

  } elseif (isset($_GET["updOrderStatus"])) {  // Order Status Link was clicked
    $curStatus = cleanInput($_GET["cur"], "int");
    $newStatus = statusCycle("OrderStatus", $curStatus);
    // Update OrderStatus Status
    $updateStatus = $order->updateOrderStatus($orderID, $newStatus);

    // Fix Sidebar Orders Badge
    $toSendCount = $order->countOrdStat(1);  // NOTE: HardCoded based on "Paid" status in Config/$statusCodes/OrderStatus
    $toSendBadge = ($toSendCount > 0) ? " <span class='badge badge-primary'>To Send: {$toSendCount}</span>" : "";
    // Update SideBar ToSend ?>
    <script>
      document.getElementById("toSendBadge").innerHTML = "<?= $toSendBadge ?>";
    </script><?php

  } elseif (isset($_GET["updItemStatus"])) {  // Item Status Link was clicked
    $orderItemID = cleanInput($_GET["itemID"], "int");
    $curStatus = cleanInput($_GET["cur"], "int");
    $newStatus = statusCycle("Status", $curStatus);
    // Update OrderItem Status  
    $updateStatus = $orderItem->updateStatus($orderItemID, $newStatus);

  } elseif (isset($_GET["updItemIsShipped"])) {  // Item Shipped Link was clicked
    $orderItemID = cleanInput($_GET["itemID"], "int");
    $curStatus = cleanInput($_GET["cur"], "int");
    $newStatus = statusCycle("IsShipped", $curStatus);
    // Update OrderItem IsShipped
    $updateStatus = $orderItem->updateIsShipped($orderItemID, $newStatus);
  } 
}
$_GET = [];

// Process OrderItem Updates if Update Order POSTed
if (isset($_POST["updateOrder"])){
  $update = 0;
  foreach ($_POST["ordItems"] as $key => $value) {
    if (empty($value["shippedDate"])) $value["shippedDate"] = "0000-00-00";
    $update += $orderItem->updateShippedDate($key, $value["shippedDate"]);
  }
  if ($update > 0) $_SESSION["message"] = msgPrep("success", "Order updated successfully.<br />");
}
$_POST = [];

// Get Order Details for selected Record
$orderRecord = $order->getRecord($orderID);

// Show Details in Order Header
include "../app/views/admin/orderHeader.php";

// Get List of order items for selected order
$orderItemList = $orderItem->getItemsByOrder($orderID);

// Display Order Items List View
include "../app/views/admin/orderItemsList.php";
?>