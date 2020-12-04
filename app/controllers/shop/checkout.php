<?php  // Shop - Checkout
include_once "../app/models/invoiceIDClass.php";
$invoiceID = new InvoiceID();
include_once "../app/models/countryClass.php";
$country = new Country();
include_once "../app/models/shippingClass.php";
$shipping = new Shipping;

$renderPayPalButtons = false;  // Initial Setting to not render PayPal Buttons

// Update Cart if Shipping Details were updated
if (isset($_POST["updateShipping"])) {
  $_SESSION["cart"][0]["shippingInstructions"] = cleanInput($_POST["shipInstructions"], "string");
  $_SESSION["cart"][0]["shippingCountry"] = cleanInput($_POST["shipToCountry"], "string");
  $_SESSION["cart"][0]["shippingType"] = cleanInput($_POST["shippingPriority"], "string");

  // Get an Invoice ID & Clear ppOrderID & ppOrderStatus
  $_SESSION["cart"][0]["invoiceID"] = $invoiceID->getInvoiceID();
  $_SESSION["cart"][0]["ppOrderID"] = "";
  $_SESSION["cart"][0]["ppOrderStatus"] = "";

  // Get Shipping Band for Shipping Country
  $shippingBand = $country->getShippingBand($_SESSION["cart"][0]["shippingCountry"]);

  // Update Shipping PriceBandKG based on Band, Type and Weight
  foreach($shipping->getPriceBandKGs($shippingBand, $_SESSION["cart"][0]["shippingType"], 1) as $value) {
    $_SESSION["cart"][0]["shippingPriceBandKG"] = $value["PriceBandKG"];
    if ($_SESSION["cart"][0]["shippingWeightKG"] <= $value["PriceBandKG"]) break;
  }

  // Get Shipping Costs & Update Total Value
  $_SESSION["cart"][0]["shippingCost"] = $shipping->getShippingCost($shippingBand, $_SESSION["cart"][0]["shippingType"], $_SESSION["cart"][0]["shippingPriceBandKG"]);

  $_SESSION["cart"][0]["total"] = $_SESSION["cart"][0]["subTotal"] + $_SESSION["cart"][0]["shippingCost"];

  // Set Flag to now render PayPal Buttons
  $renderPayPalButtons = true;
}
$_POST = [];

// Set whether Proceed to Checkout Button is displayed in cartList
$checkoutButton = false;

// Show Checkout Summary
include "../app/views/shop/checkoutSummary.php";

if ($renderPayPalButtons == true) : ?>
  <!-- Render PayPal Buttons -->
  <script>
    paypal.Buttons({
      style: {
        label: "buynow"
      },
      // Return to checkout page if PayPal transaction cancelled
      onCancel: function (data) {
        window.location = "index.php?p=checkout";
      },
      // Set up the details of the transaction
      createOrder: function() {
        document.getElementById("paypal-processing").innerHTML = "<div class='alert alert-warning'>Processing Order. Please Wait...</div>";
        return fetch("ppCreateOrder.php", {
          method: "POST",
          headers: {
            "content-type": "application/json"
          },
          body: JSON.stringify({
            invoiceID: "<?= $_SESSION["cart"][0]["invoiceID"] ?>",
            currencyCode: "<?= DEFAULTS["currency"] ?>",
            value: <?= $_SESSION["cart"][0]["total"] ?>
          })
        }).then(function(response) {
          // console.log(response);
          if (response.ok && response.status == 200) {
            return response.json();
          } else {
            alert("Error Processing PayPal Payment");
            window.location = "index.php?p=checkout";
          }
        }).then(function(details) {
          console.log(details);
          return details.result.id;
        });
      },
      // This function checks for Shipping Address Changes
      onShippingChange: function(data, actions) {
        return fetch("ppUpdateShipping.php", {
          method: "POST",
          headers: {
            "content-type": "application/json"
          },
          body: JSON.stringify({
            shippingCountry: data.shipping_address.country_code
          })
        }).then(function(response){
          // console.log(response);
          if (response.ok && response.status == 200) {
            return response.json();
          } else {
            alert("Error Processing PayPal Payment");
            window.location = "index.php?p=checkout";
          }
        }).then(function(details){
          console.log(details);
          return actions.order.patch([{
            op: "replace",
            path: "/purchase_units/@reference_id==\'default\'/amount",
            value: {
              "currency_code": "<?= DEFAULTS["currency"] ?>",
              "value": details,
            }
          }]);
        });
      },
      // Captures the funds from the transaction
      onApprove: function(data) {
        console.log(data);
        return fetch("ppCaptureOrder.php", {
          method: "POST",
          headers: {
            "content-type": "application/json"
          },
          body: JSON.stringify({
            orderID: data.orderID
          })
        }).then(function(response){
          // console.log(response);
          if (response.ok && response.status == 200) {
            return response.json();
          } else {
            alert("Error Processing PayPal Payment");
            window.location = "index.php?p=checkout";
          }
        }).then(function(details){
          console.log(details);
          window.location = "index.php?p=orderConfirmation";
        });
      }
    }).render("#paypal-button-container");
  </script><?php
endif; ?>