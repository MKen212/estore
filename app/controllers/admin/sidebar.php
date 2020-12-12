<?php  // Admin Dashboard - Sidebar
include_once "../app/models/orderClass.php";
$order = new Order();
include_once "../app/models/returnsClass.php";
$returns = new Returns();
include_once "../app/models/messageClass.php";
$message = new Message();

// Update Orders/toSend count & badge
$toSendCount = $order->countOrdStat(1);  // NOTE: HardCoded based on "Paid" status in Config/$statusCodes/OrderStatus
if ($toSendCount > 0) {
  $toSendBadge = " <span class='badge badge-primary'>To Send: {$toSendCount}</span>";
} else {
  $toSendBadge = "";
}

// Update Returns/toProcess count & badge
$toProcessCount = $returns->countRetStat(1);  // NOTE: HardCoded based on "Returned" status in Config/$statusCodes/ReturnStatus
if ($toProcessCount > 0) {
  $toProcessBadge = " <span class='badge badge-warning'>To Process: {$toProcessCount}</span>";
} else {
  $toProcessBadge = "";
}

// Update Messages/toRespond count & badge
$toRespondCount = $message->countMsgStat(1);  // NOTE: HardCoded based on "Unread" & "Read" status in Config/$statusCodes/MessageStatus
if ($toRespondCount > 0) {
  $toRespondBadge = " <span class='badge badge-info'>To Respond: {$toRespondCount}</span>";
} else {
  $toRespondBadge = "";
}

// Display Sidebar
include "../app/views/admin/sidebar.php";
?>