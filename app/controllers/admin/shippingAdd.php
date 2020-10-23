<!-- Admin Dashboard - Shipping Rate Add -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Add Shipping Rate</h2>
</div>

<?php
// Initialise Shipping Data
$shippingData = [
  "Band" => SHIPPING_VALUES["Bands"][0],
  "Type" => SHIPPING_VALUES["Types"][0],
  "PriceBandKG" => null,
  "PriceBandCost" => null,
  "Status" => 1,
];

// Show Shipping Form
$formData = [
  "subName" => "addShipping",
  "subText" => "Add Rate",
];
include "../app/views/admin/shippingForm.php";

if (isset($_POST["addShipping"])) {  // Add Shipping Record
  // Clean Fields for DB Entry
  $band = $_POST["band"];
  $type = $_POST["type"];
  $priceBandKG = cleanInput($_POST["priceBandKG"], "int");
  $priceBandCost = cleanInput($_POST["priceBandCost"], "float");
  $status = $_POST["status"];
  $_POST = [];

  // Create database entry
  include_once "../app/models/shippingClass.php";
  $shipping = new Shipping();
  $newShippingID = $shipping->add($band, $type, $priceBandKG, $priceBandCost, $status);

  // Refresh page
  ?><script>
    window.location.assign("admin_dashboard.php?p=shippingAdd");
  </script><?php
}
?>