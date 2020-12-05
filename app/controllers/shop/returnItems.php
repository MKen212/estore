<?php  // Shop - Return Items
include_once "../app/models/orderClass.php";
$order = new Order();
include_once "../app/models/orderItemClass.php";
$orderItem = new OrderItem();

// Get recordID if provided
$orderID = 0;
if (isset($_GET["id"])) {
  $orderID = cleanInput($_GET["id"], "int");
}
$_GET = [];

// Check Order is owned by current user and currently Active & then get Returns Available
$isOwner = false;
$isActive = false;
$refData = $order->getRefData($orderID);
if ($_SESSION["userID"] == $refData["OwnerUserID"]) {
  $isOwner = true;
  if ($refData["Status"] == 1) {
    $isActive = true;
    // Get List of ACTIVE order items available for return selected order
    $returnsAvailList = $orderItem->getReturnsAvailByOrder($orderID, 1);
  }
}

// Show Details in Returns Available List View
include "../app/views/shop/returnsAvailList.php";
?>