<?php   // Admin Dashboard - Sidebar Badges

// Update toSend count & badge
include_once "../app/models/orderClass.php";
$order = new Order();
$toSendCount = $order->countOrdStat(1);  // NOTE: HardCoded based on "Paid" status in Config/$statusCodes/OrderStatus
if ($toSendCount > 0) {
  $toSendBadge = " <span class='badge badge-primary'>To Send: $toSendCount</span>";
} else {
  $toSendBadge = "";
}

// Update toRefund count & badge
include_once "../app/models/returnsClass.php";
$returns = new Returns();
$toRefundCount = $returns->countRetStat(1);  // NOTE: HardCoded based on "Returned" status in Config/$statusCodes/ReturnStatus
if ($toRefundCount > 0) {
  $toRefundBadge = " <span class='badge badge-warning'>To Refund: $toRefundCount</span>";
} else {
  $toRefundBadge = "";
}
?>