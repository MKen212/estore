<?php  // Update Shipping Cost & Revised Total
session_start();

if (!isset($_SESSION["cart"][0])) {  // Reject User without a Shopping Cart
  http_response_code(403);  // Forbidden
} else {
  require "../app/config/_config.php";
  require "../app/helpers/helperFunctions.php";
  require "../vendor/autoload.php";

  // Get body contents
  $body = file_get_contents("php://input");
  $bodyObj = json_decode($body);

  // Get Shipping Band for Country Specified
  include_once "../app/models/countryClass.php";
  $country = new Country();
  $shippingBand = $country->getShippingBand($bodyObj->shippingCountry);
  
  // Get Shipping Costs for relevant Shipping band
  include_once "../app/models/shippingClass.php";
  $shipping = new Shipping;
  $newShippingCosts = $shipping->getShippingCost($shippingBand, $_SESSION["cart"][0]["shippingType"], $_SESSION["cart"][0]["shippingPriceBandKG"]);

  if($newShippingCosts) {  // If New Shipping Costs retrieved
    // Update Shopping Cart
    $_SESSION["cart"][0]["shippingCountry"] = $bodyObj->shippingCountry;
    $_SESSION["cart"][0]["shippingCost"] = $newShippingCosts;
    $_SESSION["cart"][0]["total"] = $_SESSION["cart"][0]["subTotal"] + $_SESSION["cart"][0]["shippingCost"];

    // Output the revised total in JSON format
    header("Content-type: application/json");
    echo json_encode($_SESSION["cart"][0]["total"]);
  } else {
    http_response_code(204);  // No Content
  }
}
?>