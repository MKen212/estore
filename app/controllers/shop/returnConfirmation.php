<?php  // Shop - Return Confirmation
$return = [];  // returns record  
$returnItems = [];  // return_items record

if (isset($_POST["selectReturns"])) {
  $return = [
    "orderID" => $_POST["orderID"],
    "invoiceID" => $_POST["invoiceID"],
    "itemCount" => 0,
    "productCount" => 0,
    "total" => 0,
  ];
  // Loop through $_POST["returns"] to build returnItems array
  foreach($_POST["returns"] as $key => $value) {
    if (isset($value["orderItemID"])) {
      $return["itemCount"] += 1;
      $return["productCount"] += $value["qtyReturned"];
      $return["total"] += ($value["qtyReturned"] * $value["price"]);
      array_push($returnItems, $value);
    }
  }
  $_POST = [];
}

// Check $returns contains returns data
if (empty($returnItems)) {
  $_SESSION["message"] = msgPrep("danger", "Error - No items selected for return.<br />");
  // Revert to Home Screen ?><script>
    window.location.assign("index.php?p=home");
  </script><?php
} else {
  // Build New Return Record

  // UP TO HERE. NEED TO BUILD RETURNS / RETURN_ITEMS MODELS and then process returns

  $_SESSION["message"] = msgPrep("success", ("Your Return Request was processed successfully. The details are as follows:<br />"));

  // Show the return details
  include "../app/controllers/shop/returnDetails.php";
}

?>