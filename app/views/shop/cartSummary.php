<!-- Cart Summary - SHOP -->
<section id="cart_items">
  <div class="container">
    <!-- Title Block -->
    <div class="row">
      <div class="col-sm-12 bg">
        <h2 class="title text-center">Shopping Cart</h2>
      </div>
    </div>
    <!-- System Messages -->
    <div class="row"><?php
      msgShow(); ?>
    </div>

    <!-- Cart Summary -->
    <div class="row"><?php
      if (!isset($_SESSION["cart"][0])) :  // Check Cart has items ?>
        <div class="register-req">
          <p>Your Shopping Cart is currently empty. Please visit our <a href="index.php?p=products">Shop</a> to proceed.</p>
        </div><?php
      else : 
        // Display Cart List
        include "../app/views/shop/cartList.php";
      endif; ?>
    </div>
  </div>
</section>