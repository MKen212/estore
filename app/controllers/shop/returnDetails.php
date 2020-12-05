<?php  // Shop - Return Details
include_once "../app/models/returnsClass.php";
$returns = new Returns();
include_once "../app/models/returnItemClass.php";
$returnItem = new ReturnItem();

// Get recordID if provided
$returnID = 0;
if (isset($_GET["id"])) {
  $returnID = cleanInput($_GET["id"], "int");
}
$_GET = [];

// Check Return is owned by current user and currently Active & then get Record
$isOwner = false;
$isActive = false;
$refData = $returns->getRefData($returnID);
if ($_SESSION["userID"] == $refData["OwnerUserID"]) {
  $isOwner = true;
  if ($refData["Status"] == 1) {
    $isActive = true;
    // Get Return Details for selected Record
    $returnRecord = $returns->getRecord($returnID);
    // Get List of ACTIVE return items for selected return
    $returnItemList = $returnItem->getItemsByReturn($returnID, 1);
  }
}

// Show Details in Return Details View
include "../app/views/shop/returnDetails.php";
?>