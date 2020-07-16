<?php  // Shop - Checkout
if (!isset($_POST["saveShopper"])) {  // User has not just POSTed new shopper info
  if (isset($_SESSION["cart"][0]["shopperInfo"]["saveShopper"])) {  // User has previously saved shopper info
    $_POST = $_SESSION["cart"][0]["shopperInfo"];
    unset($_POST["saveShopper"]);
  } else if (isset($_SESSION["userLogin"])) {  // User is logged in so get User Record
    include_once("../app/models/userClass.php");
    $user = new User;
    $_POST = $user->getRecord($_SESSION["userID"]);
  }
}
?>

<section id="cart_items"><!--checkout-->
  <div class="container">
    <div class="heading">
		  <h3>Checkout</h3>
    </div>
    
    <?php  // Check Cart has Items
    if (!isset($_SESSION["cart"][0])) :?>
      <div style="margin-bottom:50px">Your Shopping Cart is currently empty.</div>
    <?php else :?>

      <div class="register-req">
        <p>Please <a href="">Login</a> to use the billing information from your account, or continue as a Guest</p>
      </div>

      <?php
        include("../app/views/shop/shopperForm.php");

        if (isset($_POST["saveShopper"])) {  // Save ShopperInfo to $_SESSION
          $_SESSION["cart"][0]["shopperInfo"] = $_POST;

          // Display Cart ?>
          <div class="review-payment" id="cont">
            <h2>Review Order</h2>
          </div><?php

          include("../app/controllers/shop/cartList.php");

          // Update Shipping Band based on Ship To Country Code
          include_once("../app/models/countryClass.php");
          $country = new Country;
          $_SESSION["cart"][0]["shippingBand"] = $country->getShippingBand($_SESSION["cart"][0]["shopperInfo"]["ShipCountryCode"]);

          // Update Shipping Cost based on Shipping Band and Shipping Weight
          if ($_SESSION["cart"][0]["shippingWeightKG"] <= 2) {
            $priceBandKG = 2;
          } else if ($_SESSION["cart"][0]["shippingWeightKG"] <= 5) {
            $priceBandKG = 5;
          } else {
            $priceBandKG = 10;
          }
          include_once("../app/models/shippingClass.php");
          $shipping = new Shipping;
          $shippingCosts = $shipping->getShippingCosts($_SESSION["cart"][0]["shippingBand"], $priceBandKG);
          foreach ($shippingCosts as $value) {
            if ($value["Type"] == $_SESSION["cart"][0]["shippingType"]) {
              $_SESSION["cart"][0]["shippingCost"] = $value["PriceBandCost"];
            }
          }          
          $_SESSION["cart"][0]["total"] += $_SESSION["cart"][0]["shippingCost"];
        
          // Display Shipping Summary ?>
          <div class="review-payment" id="ship">
            <h2>Shipping & Payment</h2>
          </div><?php
          
          include("../app/views/shop/checkoutSummary.php");

        }
  
      endif;?>

    <div>
      <pre>
      <?php
        echo "SESSION: ";
        print_r($_SESSION);
        echo "<br />POST: ";
        print_r($_POST);
      ?>
      </pre>
    </div>
  </div>
</section><!--/checkout-->