<?php  // Admin Dashboard - Orders List/Edit
include_once "../app/models/orderClass.php";
$order = new Order();

// Fix InvoiceID Search if entered
$invoiceID = null;
if (isset($_POST["orderSearch"])){
  $invoiceID = fixSearch($_POST["schOrder"]);
}
$_POST = [];

// Get List of orders
$orderList = $order->getList($invoiceID);

// Display Orders List View
include "../app/views/admin/ordersList.php";
?>