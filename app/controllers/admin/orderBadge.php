<?php   // Admin Dashboard - Order Badge
include_once "../app/models/orderClass.php";
$order = new Order();

// Update toSend count & badge
$toSendCount = $order->count(DEFAULTS["orderStatusToSend"]);
if ($toSendCount > 0) {
  $toSendBadge = " <span class='badge badge-primary'>Send: $toSendCount</span>";
} else {
  $toSendBadge = "";
}

// Update toRefund count & badge
$toRefundCount = $order->count(DEFAULTS["orderStatusToRefund"]);
if ($toRefundCount > 0) {
  $toRefundBadge = " <span class='badge badge-warning'>Refund: $toRefundCount</span>";
} else {
  $toRefundBadge = "";
}
?>