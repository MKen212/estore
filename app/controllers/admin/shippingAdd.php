<?php   // Admin Dashboard - Shipping Rate Add
include_once "../app/models/shippingClass.php";
$shipping = new Shipping();

// Add Shipping Record if Add POSTed
if (isset($_POST["addShipping"])) {
  $band = cleanInput($_POST["band"], "string");
  $type = cleanInput($_POST["type"], "string");
  $priceBandKG = cleanInput($_POST["priceBandKG"], "int");
  $priceBandCost = cleanInput($_POST["priceBandCost"], "float");
  $status = cleanInput($_POST["status"], "int");

  // Create database entry
  $newShippingID = $shipping->add($band, $type, $priceBandKG, $priceBandCost, $status);

  if ($newShippingID) {  // Database Entry Success
    $_POST = [];
  }
}

// Initialise Shipping Record
$shippingRecord = [
  "Band" => postValue("band"),
  "Type" => postValue("type"),
  "PriceBandKG" => postValue("priceBandKG"),
  "PriceBandCost" => postValue("priceBandCost"),
  "Status" => postValue("status", 1),
];

// Prep Shipping Form Data
$formData = [
  "formUsage" => "Add",
  "formTitle" => "Add Shipping Rate",
  "subName" => "addShipping",
  "subText" => "Add Rate",
];

// Show Shipping Form
include "../app/views/admin/shippingForm.php";
?>