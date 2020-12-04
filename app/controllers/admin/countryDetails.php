<?php  // Admin Dashboard - Country Details
include_once "../app/models/countryClass.php";
$country = new Country();

// Get recordID if provided
$countryID = 0;
if (isset($_GET["id"])) {
  $countryID = cleanInput($_GET["id"], "int");
}
$_GET = [];

// Update Country Record if Update POSTed
if (isset($_POST["updateCountry"])) {
  $code = cleanInput($_POST["code"], "string");
  $name = cleanInput($_POST["name"], "string");
  $shippingBand = cleanInput($_POST["shippingBand"], "string");
  $status = cleanInput($_POST["status"], "int");

  // Update database entry
  $updateCountry = $country->updateRecord($countryID, $code, $name, $shippingBand, $status);
}
$_POST = [];

// Get Country Details for selected record
$countryRecord = $country->getRecord($countryID);

// Prep Country Form Data
$formData = [
  "formUsage" => "Update",
  "formTitle" => "Shipping Country Details - ID: {$countryID}",
  "subName" => "updateCountry",
  "subText" => "Update Country",
];

// Show Country Form
include "../app/views/admin/countryForm.php";
?>