<?php   // Admin Dashboard - Sidebar Badges

// Update Orders/toSend count & badge
include_once "../app/models/orderClass.php";
$order = new Order();
$toSendCount = $order->countOrdStat(1);  // NOTE: HardCoded based on "Paid" status in Config/$statusCodes/OrderStatus
if ($toSendCount > 0) {
  $toSendBadge = " <span class='badge badge-primary'>To Send: $toSendCount</span>";
} else {
  $toSendBadge = "";
}

// Update Returns/toProcess count & badge
include_once "../app/models/returnsClass.php";
$returns = new Returns();
$toProcessCount = $returns->countRetStat(1);  // NOTE: HardCoded based on "Returned" status in Config/$statusCodes/ReturnStatus
if ($toProcessCount > 0) {
  $toProcessBadge = " <span class='badge badge-warning'>To Process: $toProcessCount</span>";
} else {
  $toProcessBadge = "";
}

// Update Messages/toRespond count & badge
$toRespondCount = 12;
$toRespondBadge = " <span class='badge badge-info'>To Respond: $toRespondCount</span>";

?>