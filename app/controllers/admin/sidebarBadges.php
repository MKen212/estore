<?php   // Admin Dashboard - Sidebar Badges

// Update toSend count & badge
include_once "../app/models/orderClass.php";
$order = new Order();
$toSendCount = $order->countOrdStat(DEFAULTS["orderStatusToSend"]);
if ($toSendCount > 0) {
  $toSendBadge = " <span class='badge badge-primary'>To Send: $toSendCount</span>";
} else {
  $toSendBadge = "";
}

// Update toRefund count & badge
$toRefundCount = 2;  // TODO
if ($toRefundCount > 0) {
  $toRefundBadge = " <span class='badge badge-warning'>To Refund: $toRefundCount</span>";
} else {
  $toRefundBadge = "";
}
?>