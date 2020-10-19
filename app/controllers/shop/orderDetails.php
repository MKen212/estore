<?php  // Shop - Order Details

?>
<section id="cart_items"><!--order_details-->
  <div class="container">
    <div class="heading">
		  <h3>Order Details</h3>
    </div>

    <?php
    msgShow();  // Show any system messages coming from orderConfirmation

    if (!isset($_GET["id"])) :  // Check OrderID Provided ?>
      <div class="register-req">
		    <p>No Order ID provided.</p>
      </div>
    <?php else :
      $orderID = $_GET["id"];
      $_GET = [];
      include_once "../app/models/orderClass.php";
      $order = new Order();

      $refData = $order->getRefData($orderID);
      if ($_SESSION["userID"] != $refData["OwnerUserID"]) : // Check Order is owned by current user ?>
        <div class="register-req">
		      <p>Sorry - You do not have access to Order ID `<?= $orderID ?>` for Invoice ID '<?= $refData["InvoiceID"] ?>'.</p>
        </div>
      <?php else :
        // Get Order Details
        $orderDetails = $order->getDetails($orderID);

        // Update Shipping Instructions if none
        if (empty($orderDetails["ShippingInstructions"])) $orderDetails["ShippingInstructions"] = "- None -";

        // Show Details in Order Header
        include "../app/views/shop/orderHeader.php";

        // Show Order Items
        ?>
        <div class="row" style="margin-bottom:50px"><!--order_items-->
          <div class="col-sm-12 shopper-info">
            <h5>Ordered Items</h5>
            <div class="table-responsive cart_info">
              <table class="table table-condensed" style="margin-bottom:0px">
                <thead>
                  <tr class="cart_menu">
                    <td class="image">Item</td>
                    <td class="description"></td>
                    <td class="price">Unit Price</td>
                    <td class="quantity">Quantity</td>
                    <td class="total">Item Total</td>
                    <td>Date Shipped</td>
                    <td>Return</td>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include_once "../app/models/orderItemClass.php";
                  $orderItem = new OrderItem();
                  // Loop through Order Items and output a row per item
                  foreach (new RecursiveArrayIterator($orderItem->getItemsByOrder($orderID)) as $record) {
                    $record["FullPath"] = getFilePath($record["ProductID"], $record["ImgFilename"]);
                    // Check if item return allowed
                    $shipInterval = date_diff(date_create("today"), date_create($record["ShippedDate"]));
                    if ($shipInterval->days <= DEFAULTS["returnsAllowance"] && $record["QtyAvailForRtn"] > 0) {
                      $record["ReturnAvailable"] = 1;
                    } else {
                      $record["ReturnAvailable"] = 0;
                    }
                    include "../app/views/shop/orderItem.php";
                  }

                  // Show Order Item Totals
                  include "../app/views/shop/orderItemTotals.php";
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div><!--/order_items-->
      <?php endif;
    endif; ?>
  </div>
</section><!--/order_details-->
