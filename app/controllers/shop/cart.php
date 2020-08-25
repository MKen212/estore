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
    ?><script>
      document.getElementById("cartItems").innerHTML = <?= $_SESSION["cart"][0]["itemCount"];?>;
    </script><?php 
  }
}

?>
<section id="cart_items"><!--cart_items-->
  <div class="container">
    <div class="heading">
		  <h3>Shopping Cart</h3>
		</div>
    
    <?php  // Display Cart
      include "../app/controllers/shop/cartList.php";
    ?>

  </div>
</section><!--/cart_items-->