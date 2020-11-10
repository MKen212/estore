<?php  //  Admin Dashboard - Message Details
isset($_GET["id"]) ? $messageID = cleanInput($_GET["id"], "int") : $messageID = 0;

// Process Status Changes if hyperlinks selected
if (isset($_GET["updStatus"])) {  // Record Status Link was clicked
  $current = $_GET["cur"];
  // $_GET=[];
  $newStatus = statusCycle("Status", $current);
  // Update Order Status
  include_once "../app/models/messageClass.php";
  $message = new Message();
  $updateStatus = $message->updateStatus($messageID, $newStatus);
} elseif (isset($_GET["updMessageStatus"])) {  // Message Status Link was clicked
  $current = $_GET["cur"];
  // $_GET=[];
  $newStatus = statusCycle("MessageStatus", $current);
  // Update MessageStatus Status
  include_once "../app/models/messageClass.php";
  $message = new Message();
  $updateStatus = $message->updateMessageStatus($messageID, $newStatus);
  // Fix Sidebar Messages Badge
  $toRespondCount = $message->countMsgStat(1);  // NOTE: HardCoded based on "Unread" & "Read" status in Config/$statusCodes/MessageStatus
  $toProcessBadge = ($toRespondCount > 0) ? " <span class='badge badge-info'>To Respond: $toRespondCount</span>" : "";
  ?><script>
    document.getElementById("toRespondBadge").innerHTML = "<?= $toProcessBadge ?>";
  </script><?php
}
$_GET = [];
?>

<!-- Main Section - Admin Message Details -->
<div class="row pt-3 pb-2 mb-3 border-bottom">
  <div class="col-6">
    <h2>Message Details - ID: <?= $messageID ?></h2>
  </div>
  <div class="col-6">
    <!-- System Messages -->
    <?php msgShow(); ?>
  </div>
</div>

<?php
// Get Message Details for selected record
include_once "../app/models/messageClass.php";
$message = new Message();
$messageData = $message->getRecord($messageID);

if ($messageData == false) :  // MessageID not found ?>
  <div>Message ID not found.</div>
<?php else :
  // Show Message Form
  include "../app/views/admin/messageForm.php";

  // Update Message Record if Reply updated
  if (isset($_POST["updateReply"])) :
    // Clean Fields for DB entry
    $reply = cleanInput($_POST["reply"], "string");
    $replyUserID = $_SESSION["userID"];
    $messageStatus = 2;  // NOTE: HardCoded based on "Replied" status in Config/$statusCodes/MessageStatus
    $_POST = [];

    $message->updateReply($messageID, $reply, $replyUserID, $messageStatus);

    // Refresh page
    ?><script>
      window.location.assign("admin_dashboard.php?p=messageDetails&id=<?= $messageID ?>");
    </script><?php
  endif;  
endif; ?>