<?php  // Admin Dashboard - Shipping Details
include_once "../app/models/shippingClass.php";
$shipping = new Shipping();

// Get recordID if provided
$shippingID = 0;
if (isset($_GET["id"])) {
  $shippingID = cleanInput($_GET["id"], "int");
}
$_GET = [];

// Update Shipping Record if Update POSTed
if (isset($_POST["updateShipping"])) {
  $band = cleanInput($_POST["band"], "string");
  $type = cleanInput($_POST["type"], "string");
  $priceBandKG = cleanInput($_POST["priceBandKG"], "int");
  $priceBandCost = cleanInput($_POST["priceBandCost"], "float");
  $status = cleanInput($_POST["status"], "int");

  // Update database entry
  $updateShipping = $shipping->updateRecord($shippingID, $band, $type, $priceBandKG, $priceBandCost, $status);
}
$_POST = [];

// Get Shipping Details for selected record
$shippingRecord = $shipping->getRecord($shippingID);

// Prep Shipping Form Data
$formData = [
  "formUsage" => "Update",
  "formTitle" => "Shipping Rate Details - ID: " . $shippingID,
  "subName" => "updateShipping",
  "subText" => "Update Rate",
];

// Show Shipping Form
include "../app/views/admin/shippingForm.php";
?>