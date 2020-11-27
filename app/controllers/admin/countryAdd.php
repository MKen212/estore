<!-- Admin Dashboard - Country Add -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Add Shipping Country</h2>
</div><?php

// Initialise Country Data
$countryData = [
  "Code" => null,
  "Name" => null,
  "ShippingBand" => SHIPPING_VALUES["Bands"][0],
  "Status" => 1,
];

// Show Country Form
$formData = [
  "subName" => "addCountry",
  "subText" => "Add Country",
];
include "../app/views/admin/countryForm.php";

if (isset($_POST["addCountry"])) {  // Add Country Record
  // Clean Fields for DB Entry
  $code = cleanInput($_POST["code"], "string");
  $name = cleanInput($_POST["name"], "string");
  $shippingBand = $_POST["shippingBand"];
  $status = $_POST["status"];
  $_POST = [];

  // Create database entry
  include_once "../app/models/countryClass.php";
  $country = new Country();
  $newCountry = $country->add($code, $name, $shippingBand, $status);

  // Refresh page
  ?><script>
    window.location.assign("admin_dashboard.php?p=countryAdd");
  </script><?php
} ?>