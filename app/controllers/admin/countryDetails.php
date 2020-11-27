<?php  // Admin Dashboard - Country Details
if (!isset($_GET["code"])) $_GET["code"] = null;  // Set CountryCode to null if not provided
?>

<!-- Main Section - Country Details -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Shipping Country Details - Code: <?= $_GET["code"] ?></h2>
</div><?php

$code = cleanInput($_GET["code"], "string");
include_once "../app/models/countryClass.php";
$country = new Country();

// Get Country Details for selected record
$countryData = $country->getRecord($code);

if ($countryData == false) :  // Country Code not found ?>
  <div>Country Code not found.</div><?php
else :
  // Show Country Form
  $formData = [
    "subName" => "updateCountry",
    "subText" => "Update Country",
  ];
  include "../app/views/admin/countryForm.php";

  if (isset($_POST["updateCountry"])) {  // Update Country Record
    $updCode = cleanInput($_POST["code"], "string");
    $name = cleanInput($_POST["name"], "string");
    $shippingBand = $_POST["shippingBand"];
    $status = $_POST["status"];
    $_POST = [];

    if ($updCode == $countryData["Code"]) $updCode = "";  // Unset $updCode if same as current record

    include_once "../app/models/countryClass.php";
    $country = new Country();
    $updateCountry = $country->updateRecord($code, $updCode, $name, $shippingBand, $status);
    if ($updateCountry == 1 && !empty($updCode)) $code = $updCode;
    // Refresh page
    ?><script>
      window.location.assign("admin_dashboard.php?p=countryDetails&code=<?= $code ?>");
    </script><?php
  }
endif; ?>