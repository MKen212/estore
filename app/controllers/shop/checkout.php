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
      }

      // Update Shipping Costs & Total Value
      include_once "../app/models/countryClass.php";
      $country = new Country();
      $shippingBand = $country->getShippingBand($_SESSION["cart"][0]["shippingCountry"]);
      
      include_once "../app/models/shippingClass.php";
      $shipping = new Shipping;
      $_SESSION["cart"][0]["shippingCost"] = $shipping->getShippingCost($shippingBand, $_SESSION["cart"][0]["shippingType"], $_SESSION["cart"][0]["shippingPriceBandKG"]);

      $_SESSION["cart"][0]["total"] = $_SESSION["cart"][0]["subTotal"] + $_SESSION["cart"][0]["shippingCost"];

      // Display Checkout Shipping Summary
      include "../app/views/shop/checkoutSummary.php";

      // If Process Payment actioned
      if (isset($_POST["processPayment"])) {
        // Display Payment Summary
        include "../app/views/shop/checkoutPayment.php";

        //  TO HERE - NEED TO ADD THE PAYPAL BUTTONS & CREATE THE ORDER
        


        // Get the next Invoice ID
        include_once "../app/models/invoiceIDClass.php";
        $invoiceID = new InvoiceID;
        $nextInvoiceID = $invoiceID->getInvoiceID();

        // Process the Order in PayPal          
        include_once "../app/models/paypalClass.php";
        $paypal = new PayPal;
        
        
        echo "Current Invoice ID: {$nextInvoiceID}<br />";
      }
    endif;?>
  </div>
</section><!--/checkout-->

<!-- Render PayPal Buttons -->
<script>
  paypal.Buttons({
    style: {
      label: "buynow"
    },
    // This function sets up the details of the transaction
    createOrder: function(data, actions) {
      return actions.order.create({
        purchase_units: [{
          invoice_id: "12345",
          description: "eStore Order",
          amount: {
            currency_code: "CHF",
            value: "5.00"
          }
        }]
      });
    // createOrder: function() {
    //   return fetch("https://raspi3b-5c2a9c65/tutorials/PayPal/SDKDemo/ppCreateOrder.php", {
    //     method: "POST",
    //     headers: {
    //       "content-type": "application/json"
    //     }
    //   }).then(function(response) {
    //     console.log(response);
    //     if (response.ok && response.status == 200) {
    //       return response.json();
    //     } else {
    //       window.location = "checkout.php";
    //     }
    //   }).then(function(data) {
    //     console.log(data);
    //     return data.result.id;
    //   });
    // },
    // // This function checks the Shipping Address
    // onShippingChange: function(data, actions) {
    //   if (data.shipping_address.country_code  !== " $shipCountry ") {
    //     let newValue = "5.00";
    //     if (data.shipping_address.country_code == "CH") {
    //       newValue = "8.00";
    //     } else if (data.shipping_address.country_code == "GB" || data.shipping_address.country_code == "FR") {
    //       newValue = "11.00";
    //     } else {
    //       newValue = "14.00";
    //     }
    //     return actions.order.patch([{
    //       op: "replace",
    //       path: "/purchase_units/@reference_id==\'default\'/amount",
    //       value: {
    //         "currency_code": "CHF",
    //         "value": newValue,
    //       }
    //     }]);
    //   }
    // },
    // // This function captures the funds from the transaction
    // onApprove: function(data) {
    //   console.log(data);
    //   return fetch("https://raspi3b-5c2a9c65/tutorials/PayPal/SDKDemo/ppCaptureOrder.php", {
    //     method: "POST",
    //     headers: {
    //       "content-type": "application/json"
    //     },
    //     body: JSON.stringify({
    //       orderID: data.orderID
    //     })
    //   }).then(function(response){
    //     console.log(response);
    //     if (response.ok && response.status == 200) {
    //       return response.json();
    //     } else {
    //       window.location = "checkout.php";
    //     }
    //   }).then(function(details){
    //     console.log(details);
    //     // alert('Transaction funds captured from ' + details.payer_given_name);
    //     document.getElementById("paypal-result").innerHTML = JSON.stringify(details);
    //   });
    }
  }).render("#paypal-button-container");
</script>