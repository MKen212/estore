<?php  // Shop - Shopping Cart
if (isset($_GET["mt"])) {  // User has Opted to Empty Cart
  unset($_SESSION["cart"]);
}

?>
<section id="cart_items"><!--cart_items-->
  <div class="container">
    <div class="heading">
		  <h3>Shopping Cart</h3>
		</div>
    
    <?php  // Display Cart
      include("../app/controllers/shop/cartList.php");
    ?>

  </div>
</section><!--/cart_items-->