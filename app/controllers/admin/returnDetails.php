<?php  // Admin Dashboard - Return Details
include_once "../app/models/returnsClass.php";
$returns = new Returns();
include_once "../app/models/returnItemClass.php";
$returnItem = new ReturnItem();
include_once "../app/models/paypalClass.php";
$paypal = new PayPal();

// Get recordID if provided and process Status changes if hyperlinks clicked
$returnID = 0;
if (isset($_GET["id"])) {
  $returnID = cleanInput($_GET["id"], "int");

  if (isset($_GET["updStatus"])) {  // Record Status Link was clicked
    $curStatus = cleanInput($_GET["cur"], "int");
    $newStatus = statusCycle("Status", $curStatus);
    // Update Returns Status
    $updateStatus = $returns->updateStatus($returnID, $newStatus);

  } elseif (isset($_GET["updReturnStatus"])) {  // Return Status Link was clicked
    $curStatus = cleanInput($_GET["cur"], "int");
    $newStatus = statusCycle("ReturnStatus", $curStatus);
    // Update ReturnStatus Status
    $returns->updateReturnStatus($returnID, $newStatus);

    // Fix Sidebar Returns Badge
    $toProcessCount = $returns->countRetStat(1);  // NOTE: HardCoded based on "Returned" status in Config/$statusCodes/ReturnStatus
    $toProcessBadge = ($toProcessCount > 0) ? " <span class='badge badge-warning'>To Process: {$toProcessCount}</span>" : "";
    // Update SideBar ToProcess ?>
    <script>
      document.getElementById("toProcessBadge").innerHTML = "<?= $toProcessBadge ?>";
    </script><?php

  } elseif (isset($_GET["updItemStatus"])) {  // Item Status Link was clicked
    $returnItemID = cleanInput($_GET["itemID"], "int");
    $curStatus = cleanInput($_GET["cur"], "int");
    $newStatus = statusCycle("Status", $curStatus);
    // Update ReturnItem Status
    $updateStatus = $returnItem->updateStatus($returnItemID, $newStatus);

  } elseif (isset($_GET["updItemIsReceived"])) {  // Item Received Link was clicked
    $returnItemID = cleanInput($_GET["itemID"], "int");
    $curStatus = cleanInput($_GET["cur"], "int");
    $newStatus = statusCycle("IsReceived", $curStatus);
    // Update OrderItem IsReceived
    $updateStatus = $returnItem->updateIsReceived($returnItemID, $newStatus);

  } elseif (isset($_GET["updItemIsActioned"])) {  // Item Actioned Link was clicked
    $returnItemID = cleanInput($_GET["itemID"], "int");
    $curStatus = cleanInput($_GET["cur"], "int");
    $newStatus = statusCycle("IsActioned", $curStatus);
    // Update OrderItem IsActioned
    $updateStatus = $returnItem->updateIsActioned($returnItemID, $newStatus);

  } elseif (isset($_GET["refund"])) {  // Process Refund Link was clicked
    $invoiceID = cleanInput($_GET["invId"], "int");
    $noteToPayer = "Refund for Return {$invoiceID}-RTN-{$returnID}";
    $paymentID = cleanInput($_GET["payId"], "string");
    $value = cleanInput($_GET["value"], "float");
    // Process Refund
    $paypal->refundPayment($invoiceID, $noteToPayer, DEFAULTS["currency"], $value, $paymentID, $returnID);
  }
}
$_GET = [];

// Process ReturnItem Updates if Update Return POSTed
if (isset($_POST["updateReturn"])){
  $update = 0;
  foreach ($_POST["retItems"] as $key => $value) {
    if (empty($value["receivedDate"])) $value["receivedDate"] = "0000-00-00";
    if (empty($value["actionedDate"])) $value["actionedDate"] = "0000-00-00";
    $update += $returnItem->updateProcessedDates($key, $value["receivedDate"], $value["actionedDate"]);
  }
  if ($update > 0) $_SESSION["message"] = msgPrep("success", "Return updated successfully.<br />");
}
$_POST = [];

// Get Returns Details for selected Record
$returnRecord = $returns->getRecord($returnID);

// Get List of return items for selected order
$returnItemList = $returnItem->getItemsByReturn($returnID);

// Show Details in Returns Header
include "../app/views/admin/returnsHeader.php";

// Display Return Items List View
include "../app/views/admin/returnItemsList.php";
?>