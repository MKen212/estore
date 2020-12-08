<?php  // Shop - Message Details
include_once "../app/models/messageClass.php";
$message = new Message();

// Get recordID if provided
$messageID = 0;
if (isset($_GET["id"])) {
  $messageID = cleanInput($_GET["id"], "int");
}
$_GET = [];

// Check Message is from current user and currently Active & then get Record
$isSender = false;
$isActive = false;
$refData = $message->getRefData($messageID);
if ($_SESSION["userID"] == $refData["AddedUserID"]) {
  $isSender = true;
  if ($refData["Status"] == 1) {
    $isActive = true;
    // Get Message Details for selected Record
    $messageRecord = $message->getRecord($messageID);
  }
}

// Show Details in Message Details View
include "../app/views/shop/messageDetails.php";
?>