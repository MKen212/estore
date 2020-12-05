<?php  // Shop - Return Confirmation
include_once "../app/models/returnsClass.php";
$returns = new Returns();
include_once "../app/models/returnItemClass.php";
$returnItem = new ReturnItem();
include_once "../app/models/orderItemClass.php";
$orderItem = new OrderItem();

$newReturnID = 0;
$returnData = [];  // returns record data
$returnItemsData = [];  // return_items record data

if (isset($_POST["selectReturns"])) {
  $returnData = [
    "orderID" => cleanInput($_POST["orderID"], "int"),
    "invoiceID" => cleanInput($_POST["invoiceID"], "int"),
    "paymentID" => cleanInput($_POST["paymentID"], "string"),
    "itemCount" => 0,
    "productCount" => 0,
    "refundTotal" => 0,
  ];
  // Loop through $_POST["returns"] to build returnItemsData array
  foreach ($_POST["returns"] as $key => $value) {
    if (isset($value["orderItemID"])) {
      $returnData["itemCount"] += 1;
      $returnData["productCount"] += $value["qtyReturned"];
      if ($value["returnAction"] == 0) {  // NOTE: HardCoded based on "Replace" status in Config/$statusCodes/ReturnAction
        $value["price"] = 0;  // Return Item Price is zero if item being replaced
      }
      $returnData["refundTotal"] += ($value["qtyReturned"] * $value["price"]);
      array_push($returnItemsData, $value);
    }
  }
}
$_POST = [];

// Check $returns contains returns data
if (empty($returnItemsData)) {
  $_SESSION["message"] = msgPrep("danger", "Error - No items selected for return.<br />");
} else {
  // Build New Return Record
  $retFields = "(";
  $retValues = "(";
  foreach ($returnData as $key => $value) {
    $retFields .= "`" . ucfirst($key) . "`, ";
    $retValues .= "'{$value}', ";
  }
  $retFields .= "`OwnerUserID`, `EditUserID`)";
  $retValues .= "'{$_SESSION["userID"]}', '{$_SESSION["userID"]}')";

  // Save Return to Database
  $newReturnID = $returns->add($retFields, $retValues);

  if (!empty($newReturnID)) {  // Database Add Returns Success
    // Build New Return Items Records
    $retItmFields = "(";
    $retItmValues = "(";
    $ordItmAvailUpdates = [];  // OrderItem QtyAvailForRtn updates
    foreach ($returnItemsData as $key => $value) {
      $ordItmAvailUpdates[$value["orderItemID"]] = -$value["qtyReturned"];
      if ($key == 0) {  // Build Field List only on 1st Item
        $retItmFields .= "`ReturnID`, ";
        $retItmValues .= "'{$newReturnID}', ";
        foreach ($value as $itmKey => $itmVal) {
          $retItmFields .= "`" . ucfirst($itmKey) . "`, ";
          $retItmValues .= "'{$itmVal}', ";
        }
        $retItmFields .= "`EditUserID`)";
        $retItmValues .= "'{$_SESSION["userID"]}')";
      } else {  // Build Values only on remaining items
        $retItmValues .= ", ('{$newReturnID}', ";
        foreach ($value as $itmKey => $itmVal) {
          $retItmValues .= "'{$itmVal}', ";
        }
        $retItmValues .= "'{$_SESSION["userID"]}')";
      }
    }

    // Save Return Items to Database
    $addItems = $returnItem->addItems($retItmFields, $retItmValues);

    // Update Order Items QtyAvailForReturn
    if (!empty($addItems)) {  // Database Add Return Items Success
      // Update Order Items QtyAvailForRtn for each item
      foreach ($ordItmAvailUpdates as $orderItemID => $qtyAvailChg) {
        $ordItmUpdate = $orderItem->updateQtyAvailForRtn($orderItemID, $qtyAvailChg);
        if (!$ordItmUpdate) {  // Database OrderItems Update Failed
          return;  // Stop further processing  TO DO Fix Error Handling
        }
      }
      
      $_SESSION["message"] = msgPrep("success", ("Your Return Request was processed successfully. The details are as follows:<br />"));
    }
  }
}

// Show the return details
$_GET["id"] = $newReturnID;
include "../app/controllers/shop/returnDetails.php";
?>