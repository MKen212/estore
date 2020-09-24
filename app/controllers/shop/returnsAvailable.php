<?php  // Shop - Returns Available

?>
<section id="cart_items"><!--returns_available-->
  <div class="container">
    <div class="heading">
		  <h3>Returns Available</h3>
    </div>

    <?php  // Check User is Logged In
    if (!isset($_SESSION["userLogin"])) : ?>
      <div class="register-req">
		    <p>Please <a href="index.php?p=login">Login (or Signup)</a> to proceed.</p>
      </div>
    <?php else :  // Display Returns Available List ?>
      <!-- Returns Available List -->
      <div class="table-responsive" style="margin-bottom:75px">
        <pre>

        <!--  UP TO HERE - NEED TO FORMAT TABLE TO SHOW LIST

        <table class="table table-striped table-sm">
          <thead>  -->
            <!-- Returns Available Table Header -->
            <!--
            <th>Invoice ID</th>
            <th>Items</th>
            <th>Products</th>
            <th>Date/Time Added</th>
            <th>Value (<?= DEFAULTS["currency"] ?>)</th>
            <th>Payment Status</th>          
            <th>Order Status</th> 
          </thead>
          <tbody>  -->
            <?php
            include_once "../app/models/orderItemClass.php";
            $orderItem = new OrderItem();
            foreach(new RecursiveArrayIterator($orderItem->getReturnsAvailByUser($_SESSION["userID"], 1)) as $record) {
              // include "../app/views/shop/orderListItem.php";
              print_r($record);
            }
            ?>

          </pre>
          <!--   
          </tbody>
        </table> -->
      </div>
    <?php endif; ?>
  </div>
</section><!--/returns_available-->