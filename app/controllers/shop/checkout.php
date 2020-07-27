<?php  // Shop - Checkout
if (!isset($_POST["saveShopper"]) || isset($_POST["updateShipping"]) || isset($_POST["processCheckout"])) {  // User has not just POSTed new shopper info or HAS just updated shipping info or HAS clicked CheckOut
  if (isset($_SESSION["cart"][0]["shopperInfo"])) {  // User has previously saved shopper info
    $_POST += $_SESSION["cart"][0]["shopperInfo"];
  } else if (isset($_SESSION["userLogin"])) {  // User is logged in so get User Record
    include_once("../app/models/userClass.php");
    $user = new User;
    $_POST += $user->getRecord($_SESSION["userID"]);
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

      <?php  // Show shopper form
      include("../app/views/shop/shopperForm.php");

      if (isset($_POST["saveShopper"])) {
        // Clean ShopperInfo and save to $_SESSION
        foreach ($_POST as $key => $value) {
          if ($key == "saveShopper") {
            continue;
          } else if ($key == "Email" || $key == "ShipEmail") {
            $type = "email";
          } else {
            $type = "string";
          }
          $_SESSION["cart"][0]["shopperInfo"][$key] = cleanInput($value, $type);
        }
        // Update Shipping Band based on Ship To Country Code
        include_once("../app/models/countryClass.php");
        $country = new Country;
        $_SESSION["cart"][0]["ShippingBand"] = $country->getShippingBand($_SESSION["cart"][0]["shopperInfo"]["ShipCountryCode"]);
      }

      if (isset($_POST["saveShopper"]) || isset($_POST["updateShipping"]) || isset($_POST["processCheckout"])) { // Display Cart ?>
        <div class="review-payment" id="order">
          <h2>Review Order</h2>
        </div><?php  // Show cart

        include("../app/controllers/shop/cartList.php");

        // Update Shipping Cost based on Shipping Band and Shipping Weight
        if ($_SESSION["cart"][0]["ShippingWeightKG"] <= 2) {
          $priceBandKG = 2;
        } else if ($_SESSION["cart"][0]["ShippingWeightKG"] <= 5) {
          $priceBandKG = 5;
        } else {
          $priceBandKG = 10;
        }
        include_once("../app/models/shippingClass.php");
        $shipping = new Shipping;
        $shippingCosts = $shipping->getShippingCosts($_SESSION["cart"][0]["ShippingBand"], $priceBandKG);
        // Update Shipping Type if Shipping Details were updated
        if (isset($_POST["updateShipping"])) {
          $newKey = array_search($_POST["updatedShipValue"], array_column($shippingCosts, "PriceBandCost"));
          $_SESSION["cart"][0]["ShippingType"] = $shippingCosts[$newKey]["Type"];
        }
        foreach ($shippingCosts as $value) {
          if ($value["Type"] == $_SESSION["cart"][0]["ShippingType"]) {
            $_SESSION["cart"][0]["ShippingCost"] = $value["PriceBandCost"];
          }
        }          
        $_SESSION["cart"][0]["Total"] = $_SESSION["cart"][0]["SubTotal"] + $_SESSION["cart"][0]["ShippingCost"];
        ?>
        <div class="review-payment" id="ship">
          <h2>Shipping & Payment</h2>
        </div><?php  // Display Checkout Shipping & Payment Summary
        
        include("../app/views/shop/checkoutSummary.php");

        // If Check-Out actioned
        if (isset($_POST["processCheckout"])) {
          // First Validate Cart Items against Stock
          echo "Validating Cart Items against stock </br>";

          // Build new Order Record
          $insFields = "";
          $insValues = "";
          if ($_SESSION["userLogin"]) {
            $insFields .= "`UserID`, ";
            $insValues .= "'" . $_SESSION["userID"] . "', ";
          }
          foreach ($_SESSION["cart"][0] as $key => $value) {
            if ($key == "shopperInfo") {
              $insFields .= "`" . implode("`, `", array_keys($_SESSION["cart"][0]["shopperInfo"])) . "`";
              $insValues .= "'" . implode("', '", $_SESSION["cart"][0]["shopperInfo"]) . "'";
            } else {
              $insFields .= "`" . $key . "`, ";
              $insValues .= "'" . $value . "', ";
            }
          }
          //  Insert new Order Record into orders table
          include_once("../app/models/orderClass.php");
          $order = new Order;
          $addOrder = $order->add($insFields, $insValues);
          if ($addOrder) {  // Database Entry Success
            $resultMsg = msgPrep("success", $_SESSION["message"]);
          } else {  // Database Entry Failed
            $resultMsg = msgPrep("danger", $_SESSION["message"]);
          }


          // UP TO HERE - ADDED ORDER RECORD . NEED TO TIMESTAMP AND THEN ADD ITEMS AND OUTPUT RESULT IN AN ORDER INFO FORM OR SIMILAR
          
          
          // Insert Order Items into order_items table
          echo "Inserting Order Items into order_items table </br>";

        }
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