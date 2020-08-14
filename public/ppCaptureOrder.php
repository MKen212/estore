<?php  // Capture PayPal Order
session_start();

if (!isset($_SESSION["cart"][0])) {  // Reject User without a Shopping Cart
  http_response_code(403);  // Forbidden
} else {
  require "../app/config/_config.php";
  require "../app/helpers/helperFunctions.php";
  require "../vendor/autoload.php";

  // Initialise the PayPal API
  include_once "../app/models/paypalClass.php";
  $paypal = new PayPal;

  // Get body contents
  $body = file_get_contents("php://input");
  $bodyObj = json_decode($body);

  // Capture order
  $order = $paypal->captureOrder($bodyObj->orderID);

  if ($order) {  // If captureOrder successful
    // Output the result in JSON format
    header("Content-type: application/json");
    echo json_encode($order);
  } else {
    http_response_code(204);  // No Content
  }
}
?>