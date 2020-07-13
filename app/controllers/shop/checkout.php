<?php  // Shop - Checkout
if (!isset($_POST["saveShopper"]) && isset($_SESSION["cart"][0]["shopperInfo"]["saveShopper"])) {  // User has previously saved shopper info
  $_POST = $_SESSION["cart"][0]["shopperInfo"];
  unset($_POST["saveShopper"]);
}
if (!isset($_POST["saveShopper"]) && isset($_SESSION["userLogin"])) {  // User has not yet POSTed form and IS logged In - Get User Record
  include_once("../app/models/userClass.php");
  $user = new User;
  $_POST = $user->getRecord($_SESSION["userID"]);
}

// TO HERE ^ NEED TO FIX THAT SHIP TO IS NOT DISPLAYING MAYBE UPDATE ABOVE TO IF/ELSEIF
// NEED TO THEN ADD SHIPPING UPDATES
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

          // Display Shipping Summary ?>
          <div class="review-payment">
            <h2>Shipping & Payment</h2>
          </div><?php

          include("../app/views/shop/checkoutSummary.php");

        }
        
      ?>
    <?php endif;?>

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