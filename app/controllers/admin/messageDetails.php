<?php  //  Admin Dashboard - Message Details
include_once "../app/models/messageClass.php";
$message = new Message();

// Get recordID if provided and process Status changes if hyperlinks clicked
$messageID = 0;
if (isset($_GET["id"])) {
  $messageID = cleanInput($_GET["id"], "int");

  if (isset($_GET["updStatus"])) {  // Record Status Link was clicked
    $curStatus = cleanInput($_GET["cur"], "int");
    $newStatus = statusCycle("Status", $curStatus);
    // Update Order Status
    $updateStatus = $message->updateStatus($messageID, $newStatus);

  } elseif (isset($_GET["updMessageStatus"])) {  // Message Status Link was clicked
    $curStatus = cleanInput($_GET["cur"], "int");
    $newStatus = statusCycle("MessageStatus", $curStatus);
    // Update MessageStatus Status
    $updateStatus = $message->updateMessageStatus($messageID, $newStatus);

    // Fix Sidebar Messages To Process Badge
    $toRespondCount = $message->countMsgStat(1);  // NOTE: HardCoded based on "Unread" & "Read" status in Config/$statusCodes/MessageStatus
    $toProcessBadge = ($toRespondCount > 0) ? " <span class='badge badge-info'>To Respond: $toRespondCount</span>" : "";
    ?><script>
      document.getElementById("toRespondBadge").innerHTML = "<?= $toProcessBadge ?>";
    </script><?php
  }
}
$_GET = [];

// Update Message Record if Update Reply POSTed
if (isset($_POST["updateReply"])) {
  // Clean Fields for DB entry
  $reply = cleanInput($_POST["reply"], "string");
  $replyUserID = $_SESSION["userID"];
  $messageStatus = 2;  // NOTE: HardCoded based on "Replied" status in Config/$statusCodes/MessageStatus

  $message->updateReply($messageID, $reply, $replyUserID, $messageStatus);
}
$_POST = [];

// Get Message Details for selected record
$messageRecord = $message->getRecord($messageID);

// Show Message Form
include "../app/views/admin/messageForm.php";
?>