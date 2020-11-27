<?php  // Admin Dashboard - Shipping Details
if (!isset($_GET["id"])) $_GET["id"] = "0";  // Set ShippingID to 0 if not provided
?>

<!-- Main Section - Shipping Details -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Shipping Rate Details - ID: <?= $_GET["id"] ?></h2>
</div><?php

$id = cleanInput($_GET["id"], "int");
include_once "../app/models/shippingClass.php";
$shipping = new Shipping();

// Get Shipping Details for selected record
$shippingData = $shipping->getRecord($id);

if ($shippingData == false) :  // ShippingID not found ?>
  <div>Shipping ID not found.</div><?php
else :
  // Show Shipping Form
  $formData = [
    "subName" => "updateShipping",
    "subText" => "Update Rate",
  ];
  include "../app/views/admin/shippingForm.php";

  if (isset($_POST["updateShipping"])) {  // Update Shipping Record
    $band = $_POST["band"];
    $type = $_POST["type"];
    $priceBandKG = cleanInput($_POST["priceBandKG"], "int");
    $priceBandCost = cleanInput($_POST["priceBandCost"], "float");
    $status = $_POST["status"];
    $_POST = [];

    if ($band == $shippingData["Band"] && $type == $shippingData["Type"] && $priceBandKG == $shippingData["PriceBandKG"]) {
      // Unset $band, $type & $priceBandKG if ALL the same as current record
      $band = "";
      $type = "";
      $priceBandKG = "";
    }

    include_once "../app/models/shippingClass.php";
    $shipping = new Shipping();
    $updateShipping = $shipping->updateRecord($id, $band, $type, $priceBandKG, $priceBandCost, $status);
    // Refresh page
    ?><script>
      window.location.assign("admin_dashboard.php?p=shippingDetails&id=<?= $id ?>");
    </script><?php
  }
endif; ?>