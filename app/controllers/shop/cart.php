<?php  // Shop - Shopping Cart

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