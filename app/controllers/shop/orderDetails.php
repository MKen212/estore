<?php  // Shop - Order Details
if (!isset($_SESSION["invoiceID"])) :  // Check Invoice ID Provided ?>
  <div style="margin-bottom:50px">No Invoice ID provided.</div>
<?php else :
  include_once "../app/models/orderClass.php";
  $order = new Order();

  // Get Order Details
  $orderDetails = $order->getDetails($_SESSION["invoiceID"]);
  // Update Status Code to Text
  if ($orderDetails["Status"] = 0) {
    $orderDetails["Status"] = "Placed";
  } else if ($orderDetails["Status"] = 1) {
    $orderDetails["Status"] = "Paid";
  } else if ($orderDetails["Status"] = 2) {
    $orderDetails["Status"] = "Shipped";
  } else if ($orderDetails["Status"] = 3) {
    $orderDetails["Status"] = "Returned";
  } else if ($orderDetails["Status"] = 4) {
    $orderDetails["Status"] = "Refunded";
  }
  
  include "../app/views/shop/orderDetail.php";
  ?>

  




<?php endif; ?>