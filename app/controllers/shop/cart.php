<?php  // Shop - Shopping Cart

// Process Cart changes if hyperlinks clicked
if (isset($_GET["mt"])) {  // User has Opted to Empty Cart
  unset($_SESSION["cart"]);
  // Update Header / Cart Items ?>
  <script>
    document.getElementById("cartItems").innerHTML = null;
  </script><?php 
} elseif (isset($_GET["delItem"])) {  // User has Opted to Delete an Item from their cart
  $delID = $_GET["id"];
  if (!array_key_exists($delID, $_SESSION["cart"])) {  // Check ItemID exists
    $_SESSION["message"] = msgPrep("danger", "Item ID '{$delID}' not found in Cart.");
  } else {
    removeFromCart($delID);
    // Update Header / Cart Items ?>
    <script>
      document.getElementById("cartItems").innerHTML = <?= (isset($_SESSION["cart"])) ? $_SESSION["cart"][0]["itemCount"] : "null" ?>;
    </script><?php
  }
}
$_GET = [];

// Set whether Proceed to Checkout Button is displayed in cartList
$checkoutButton = true;

// Show Cart
include "../app/views/shop/cartSummary.php";
?>