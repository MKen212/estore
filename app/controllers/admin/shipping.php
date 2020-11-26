<?php  // Admin Dashboard - Shipping Rates List/Edit
include_once "../app/models/shippingClass.php";
$shipping = new Shipping();

// Get recordID if provided and process Status changes if hyperlinks clicked
$shippingID = 0;
if (isset($_GET["id"])) {
  $shippingID = cleanInput($_GET["id"], "int");

  if (isset($_GET["updStatus"])) {  // Status link was clicked
    $curStatus = cleanInput($_GET["cur"], "int");
    $newStatus = statusCycle("Status", $curStatus);
    // Update Shipping Status
    $updateStatus = $shipping->updateStatus($shippingID, $newStatus);
  }
}
$_GET = [];

// Fix Shipping Band/Type Search if entered
$search = null;
if (isset($_POST["shippingSearch"])) {
  $search = fixSearch($_POST["schBandOrType"]);
}
$_POST = [];

// Get List of shipping rates
$shippingList = $shipping->getList($search);

// Display Shipping List View
include "../app/views/admin/shippingList.php";
?>