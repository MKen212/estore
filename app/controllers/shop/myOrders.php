<?php  // Shop - My Orders

?>
<section id="cart_items"><!--my_orders-->
  <div class="container">
    <div class="heading">
		  <h3>My Orders</h3>
    </div>


    <!-- UP TO HERE - NEED TO FINISH MY ORDERS PAGE -->

    <!-- Orders Table List -->
    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <!-- Orders Table Header -->
          <th>Invoice ID</th>
          <th>Items</th>
          <th>Products</th>
          <th>ShipCountry</th>
          <th>ShipType</th>
          <th>Value (<?= DEFAULTS["currency"] ?>)</th>
          <th>PaymentStatus</th>
          <th>Name</th>
          <th>Date/Time Added</th>
          <th>Status</th>
        </thead>
        <tbody>
          <?php
          include_once "../app/models/orderClass.php";
          $order = new Order();
          foreach(new RecursiveArrayIterator($order->getList()) as $record) {
            include "../app/views/admin/orderListItem.php";
          }
          ?>      
        </tbody>
      </table>
    </div>

    <?php

    
    ?>

  </div>
</section><!--/order_details-->