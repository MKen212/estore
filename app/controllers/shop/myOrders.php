<?php  // Shop - My Orders

?>
<section id="cart_items"><!--my_orders-->
  <div class="container">
    <div class="heading">
		  <h3>My Orders</h3>
    </div>

    <?php  // Check User is Logged In
    if (!isset($_SESSION["userLogin"])) : ?>
      <div class="register-req">
		    <p>Please <a href="index.php?p=login">Login (or Signup)</a> to proceed.</p>
      </div>
    <?php else :  // Display Order List ?>
      <!-- Orders Table List -->
      <div class="table-responsive" style="margin-bottom:75px">
        <table class="table table-striped table-sm">
          <thead>
            <!-- Orders Table Header -->
            <th>Invoice ID</th>
            <th>Items</th>
            <th>Products</th>
            <th>Date/Time Added</th>
            <th>Value</th>
            <th>Payment Status</th>          
            <th>Order Status</th>
          </thead>
          <tbody>
            <?php
            include_once "../app/models/orderClass.php";
            $order = new Order();
            $orderCount = 0;
            foreach(new RecursiveArrayIterator($order->getListByUser($_SESSION["userID"], 1)) as $record) {
              include "../app/views/shop/orderListItem.php";
              $orderCount += 1;
            }
            if ($orderCount == 0) echo "<tr><td colspan ='7'>No Orders to Display</td></tr>";
            ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>
</section><!--/my_orders-->