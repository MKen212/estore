<?php  // Shop - Shopping Cart
if (isset($_GET["mt"])) {  // User has Opted to Empty Cart
  unset($_SESSION["cart"]);
  ?><script>
    document.getElementById("cartItems").innerHTML = null;
  </script><?php 
}

if (isset($_GET["delItem"])) {  // User has Opted to Delete an Item
  $delID = $_GET["id"];
  if (!array_key_exists($delID, $_SESSION["cart"])) {  // Check ItemID exists
    $message = msgPrep("danger", "Item ID '{$delID}' not found in Cart.");
    echo $message;
  } else {
    removeFromCart($delID);
    unset($_GET["id"]);
    // Refresh page
    ?><script>
      window.location.assign("index.php?p=cart");
    </script><?php
  }
}

?>
<section id="cart_items"><!--cart_items-->
  <div class="container">
    <div class="row">
      <div class="col-sm-12 bg">
        <h2 class="title text-center">Shopping Cart</h2>
      </div>
    </div>

    <div class="row"><?php
      // Display Cart
      include "../app/controllers/shop/cartList.php";
      ?>
    </div>
  </div>
</section><!--/cart_items-->
