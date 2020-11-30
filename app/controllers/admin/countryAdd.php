<?php  // Admin Dashboard - Country Add
include_once "../app/models/countryClass.php";
$country = new Country();

// Add Country Record if Add POSTed
if (isset($_POST["addCountry"])) {
  // Clean Fields for DB Entry
  $code = cleanInput($_POST["code"], "string");
  $name = cleanInput($_POST["name"], "string");
  $shippingBand = cleanInput($_POST["shippingBand"], "string");
  $status = cleanInput($_POST["status"], "int");

  // Create database entry
  $newCountryID = $country->add($code, $name, $shippingBand, $status);

  if ($newCountryID) {  // Database Entry Success
    $_POST = [];
  }
} 

// Initialise Country Data
$countryData = [
  "Code" => postValue("code"),
  "Name" => postValue("name"),
  "ShippingBand" => postValue("shippingBand"),
  "Status" => postvalue("status", 1),
];

// Prep Country Form Data
$formData = [
  "formUsage" => "Add",
  "formTitle" => "Add Shipping Country",
  "subName" => "addCountry",
  "subText" => "Add Country",
];

// Show Country Form
include "../app/views/admin/countryForm.php";
?>