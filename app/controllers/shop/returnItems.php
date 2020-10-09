<?php  // Shop - Return Items

?>
<section id="cart_items"><!--return_items-->
  <div class="container">
    <div class="heading">
		  <h3>Returns</h3>
    </div>

    <?php
    if (!isset($_GET["id"])) :  // Check Order ID Provided ?>
      <div class="register-req">
		    <p>No Order ID provided.</p>
      </div>
    <?php else :
      $orderID = $_GET["id"];
      $_GET = [];
      include_once "../app/models/orderClass.php";
      $order = new Order();

      $refData = $order->getRefData($orderID);
      if ($_SESSION["userID"] != $refData["OwnerUserID"]) : // Check Order ID is owned by current user ?>
        <div class="register-req">
          <p>Sorry - You do not have access to Order ID `<?= $orderID ?>` with Invoice ID '<?= $refData["InvoiceID"] ?>'.</p>
        </div>
      <?php else : ?>
        <!-- Return Items Available List -->
        <div class="table-responsive" style="margin-bottom:75px">
          <p >The following lists all items shipped in the last <?= DEFAULTS["returnsAllowance"] ?> days that are available for return against <b>Invoice ID `<?= $refData["InvoiceID"] ?>`</b>:</p>
          <hr />
          <form action="index.php?p=returnConfirmation" method="POST" name="retAvailForm" autocomplete="off">
            <input type="hidden" name="orderID" value="<?= $orderID ?>" />
            <input type="hidden" name="invoiceID" value="<?= $refData["InvoiceID"] ?>" />
            <table class="table table-striped table-sm">
              <thead>
                <!-- Return Items Available Table Header -->
                <th>Item ID</th>
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
                foreach(new RecursiveArrayIterator($orderItem->getReturnsAvailByOrder($orderID, 1)) as $record) {
                  $itemCount += 1;
                  $record["FullPath"] = getFilePath($record["ProductID"], $record["ImgFilename"]);
                  include "../app/views/shop/returnsAvailItem.php";
                }
                if ($itemCount != 0) : ?>
                  <td colspan="6" style="text-align:right; padding-top:30px">Tick the items to return, update the quantities being returned and the reason for their return, and click:</td>
                  <td colspan="3" style="border-left:double">
                    <button class="btn btn-primary" type="submit" name="selectReturns">Return Selected Items</button>
                  </td>
                <?php endif; ?>
              </tbody>
            </table>  
            <?php
            if ($itemCount == 0) : ?>
              <div class="register-req">
                <p>Sorry, there are no items available for return for this order.</p>
              </div>
            <?php endif; ?>
          </form>
        </div>
      <?php endif; 
    endif; ?>
  </div>
</section><!--/return_items-->