<?php  // Shop - My Returns

?>
<section id="cart_items"><!--my_returns-->
  <div class="container">
    <div class="heading">
		  <h3>My Returns</h3>
    </div>

    <?php  // Check User is Logged In
    if (!isset($_SESSION["userLogin"])) : ?>
      <div class="register-req">
		    <p>Please <a href="index.php?p=login">Login (or Signup)</a> to proceed.</p>
      </div>
    <?php else :  // Display Returns List ?>
      <!-- Returns Table List -->
      <div class="table-responsive" style="margin-bottom:75px">
        <table class="table table-striped table-sm">
          <thead>
            <!-- Returns Table Header -->
            <th>Returns Ref</th>
            <th>Invoice ID</th>
            <th>Items</th>
            <th>Products</th>
            <th>Date/Time Added</th>
            <th>Value (<?= DEFAULTS["currency"] ?>)</th>
            <th>Returns Status</th>
          </thead>
          <tbody>
            <?php
            include_once "../app/models/returnsClass.php";
            $returns = new Returns();
            foreach(new RecursiveArrayIterator($returns->getListByUser($_SESSION["userID"], 1)) as $record) {
              $record["ReturnsRef"] = $record["InvoiceID"] . "-RTN-" . $record["ReturnID"];  // 
              include "../app/views/shop/returnsListItem.php";
            }
            ?>      
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>
</section><!--/my_returns-->