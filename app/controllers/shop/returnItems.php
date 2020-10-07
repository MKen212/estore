<?php  // Shop - Return Items

?>
<section id="cart_items"><!--return_items-->
  <div class="container">
    <div class="heading">
		  <h3>Returns</h3>
    </div>

    <?php  // Check User is Logged In
    if (!isset($_SESSION["userLogin"])) : ?>
      <div class="register-req">
		    <p>Please <a href="index.php?p=login">Login (or Signup)</a> to proceed.</p>
      </div>
    <?php else :  // Display Return Items Available List ?>
      <!-- Return Items Available List -->
      <div class="table-responsive" style="margin-bottom:75px">
        <p>The following lists all items shipped in the last <?= DEFAULTS["returnsAllowance"] ?> days:</p>
        <form action="index.php?p=returnConfirmation" method="POST" name="retAvailForm" autocomplete="off">
          <table class="table table-striped table-sm">
            <thead>
              <!-- Return Items Available Table Header -->
              <th>Invoice ID</th>
              <th>Product ID</th>
              <th>Image</th>
              <th>Name</th>
              <th>Unit Price</th>
              <th>Date Shipped</th>

              <th style="border-left:double">Return?</th>
              <th>Quantity</th>
              <th>Reason</th>
            </thead>
            <tbody>
              <?php
              include_once "../app/models/orderItemClass.php";
              $orderItem = new OrderItem();
              $itemCount = 0;
              foreach(new RecursiveArrayIterator($orderItem->getReturnsAvailByUser($_SESSION["userID"], 1)) as $record) {
                $itemCount += 1;
                $record["FullPath"] = getFilePath($record["ProductID"], $record["ImgFilename"]);
                include "../app/views/shop/returnsAvailItem.php";
              }
              if ($itemCount != 0) : ?>
                <td colspan="6" style="text-align:right; padding-top:30px">Select the items to return, update the quantities being returned and the reason for their return and click:</td>
                <td colspan="3" style="border-left:double">
                  <button class="btn btn-primary" type="submit" name="selectReturns">Return Selected Items</button>
                </td>
              <?php endif; ?>
            </tbody>
          </table>  
          <?php
          if ($itemCount == 0) : ?>
            <div class="register-req">
              <p>Sorry, there are no items available for return at this time.</p>
            </div>
          <?php endif; ?>
        </form>
      </div>
    <?php endif; ?>
  </div>
</section><!--/return_items-->