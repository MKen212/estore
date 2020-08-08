<?php  // Shop - Checkout
if (!isset($_POST["saveShopper"]) || isset($_POST["updateShipping"]) || isset($_POST["processPayment"])) {  // User has not just POSTed new shopper info or HAS just updated shipping info or HAS clicked CheckOut
  if (isset($_SESSION["cart"][0]["shopperInfo"])) {  // User has previously saved shopper info
    $_POST += $_SESSION["cart"][0]["shopperInfo"];
  } else if (isset($_SESSION["userLogin"])) {  // User is logged in so get User Record
    include_once "../app/models/userClass.php";
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
      include "../app/views/shop/shopperForm.php";

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
        include_once "../app/models/countryClass.php";
        $country = new Country;
        $_SESSION["cart"][0]["ShippingBand"] = $country->getShippingBand($_SESSION["cart"][0]["shopperInfo"]["ShipCountryCode"]);
      }

      if (isset($_POST["saveShopper"]) || isset($_POST["updateShipping"]) || isset($_POST["processPayment"])) { // Display Cart ?>
        <div class="review-payment" id="order">
          <h2>Review Order</h2>
        </div><?php  // Show cart
        // TODO Would normally validate Cart against stock at this point

        include "../app/controllers/shop/cartList.php";

        // Update Shipping Cost based on Shipping Band and Shipping Weight
        if ($_SESSION["cart"][0]["ShippingWeightKG"] <= 2) {
          $priceBandKG = 2;
        } else if ($_SESSION["cart"][0]["ShippingWeightKG"] <= 5) {
          $priceBandKG = 5;
        } else {
          $priceBandKG = 10;
        }
        include_once "../app/models/shippingClass.php";
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
        
        // Display Checkout Shipping Summary
        include "../app/views/shop/checkoutSummary.php";

        // If Process Payment actioned
        if (isset($_POST["processPayment"])) {
          // Display Payment Summary
          include "../app/views/shop/checkoutPayment.php";
        }
      }
    endif;?>
  </div>
</section><!--/checkout-->