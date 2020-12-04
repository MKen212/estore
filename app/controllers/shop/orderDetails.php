<?php  // Shop - Order Details
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

// Check Order is owned by current user and currently Active & then get Record
$isOwner = false;
$isActive = false;
$refData = $order->getRefData($orderID);
if ($_SESSION["userID"] == $refData["OwnerUserID"]) {
  $isOwner = true;
  if ($refData["Status"] == 1) {
    $isActive = true;
    // Get Order Details for selected Record
    $orderRecord = $order->getRecord($orderID);
    // Get List of ACTIVE order items for selected order
    $orderItemList = $orderItem->getItemsByOrder($orderID, 1);
    // Loop through Item List to check if each item return is allowed
    foreach ($orderItemList as $key => $value) {
      $orderItemList[$key]["ReturnAvailable"] = false;
      $shipInterval = date_diff(date_create("today"), date_create($value["ShippedDate"]));
      if ($shipInterval->days <= DEFAULTS["returnsAllowance"] && $value["QtyAvailForRtn"] > 0) {
        $orderItemList[$key]["ReturnAvailable"] = true;
      }
    }
  }
}

// Show Details in Order Details View - For all orders
include "../app/views/shop/orderDetails.php";
?>