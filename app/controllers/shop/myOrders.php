<?php  // Shop - My Orders
include_once "../app/models/orderClass.php";
$order = new Order();

// Get logged in userID
$userID = 0;
if (isset($_SESSION["userLogin"])) {
  $userID = $_SESSION["userID"];
}

// Get List of orders for Current User
$orderList = $order->getListByUser($userID, 1);

// Display Users Orders List View
include "../app/views/shop/myOrdersList.php";
?>