<?php  // Shop - Checkout

?>
<section id="cart_items"><!--checkout-->
  <div class="container">
    <div class="heading">
		  <h3>Checkout</h3>
    </div>
    
    <?php  // Check Cart has Items
    if (!isset($_SESSION["cart"][0])) :?>
      <div style="margin-bottom:50px">Your Shopping Cart is currently empty.</div>
    <?php else :  // Display Cart ?>
      <div class="review-payment" id="order">
        <h2>Review Order</h2>
      </div><?php  // Show cart
      // TODO Would normally validate Cart against stock at this point
      include "../app/controllers/shop/cartList.php";

      // Update Cart if Shipping Details were updated
      if (isset($_POST["updateShipping"])) {
        $shipInstructions = cleanInput($_POST["shipInstructions"], "string");
        $_SESSION["cart"][0]["shippingInstructions"] = $shipInstructions;
        $_SESSION["cart"][0]["shippingCountry"] = $_POST["shipToCountry"];
        $_SESSION["cart"][0]["shippingType"] = $_POST["shippingPriority"];

        // Get an Invoice ID & Clear ppOrderID & ppOrderStatus
        include_once "../app/models/invoiceIDClass.php";
        $invoiceID = new InvoiceID;
        $_SESSION["cart"][0]["invoiceID"] = $invoiceID->getInvoiceID();
        $_SESSION["cart"][0]["ppOrderID"] = "";
        $_SESSION["cart"][0]["ppOrderStatus"] = "";
      }

      // Get Shipping Costs & Update Total Value
      include_once "../app/models/countryClass.php";
      $country = new Country();
      $shippingBand = $country->getShippingBand($_SESSION["cart"][0]["shippingCountry"]);
      
      include_once "../app/models/shippingClass.php";
      $shipping = new Shipping;
      $_SESSION["cart"][0]["shippingCost"] = $shipping->getShippingCost($shippingBand, $_SESSION["cart"][0]["shippingType"], $_SESSION["cart"][0]["shippingPriceBandKG"]);

      $_SESSION["cart"][0]["total"] = $_SESSION["cart"][0]["subTotal"] + $_SESSION["cart"][0]["shippingCost"];

      // Display Checkout Shipping Summary
      include "../app/views/shop/checkoutSummary.php";
    endif;?>
  </div>
</section><!--/checkout-->

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
      if (data.shipping_address.country_code  !== "<?= $_SESSION["cart"][0]["shippingCountry"]; ?>") {
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
              "currency_code": "<?= DEFAULTS["currency"]; ?>",
              "value": details,
            }
          }]);
        });
      }
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
</script>
