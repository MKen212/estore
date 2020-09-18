<?php  // Shop - Order Details

?>
<section id="cart_items"><!--order_details-->
  <div class="container">
    <div class="heading">
		  <h3>Order Details</h3>
    </div>

    <?php
    msgShow();  // Show any system messages coming from orderConfirmation

    if (!isset($_GET["id"])) :  // Check Order ID Provided ?>
      <div class="register-req">
		    <p>No Order ID provided.</p>
      </div>
    <?php else :
      $orderID = $_GET["id"];
      $_GET = [];
      include_once "../app/models/orderClass.php";
      $order = new Order();

      $ownerID = $order->getOwner($orderID);
      if ($_SESSION["userID"] != $ownerID) : // Check Order ID is owned by current user ?>
        <div class="register-req">
		      <p>Sorry - You do not have access to Order '<?= $orderID ?>'.</p>
        </div>
      <?php else :
        // Get Order Details
        $orderDetails = $order->getDetails($orderID);

        // Update Shipping Instructions if none
        if (empty($orderDetails["ShippingInstructions"])) $orderDetails["ShippingInstructions"] = "-None-";

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
                    <td >Item Status</td>
                  </tr>
                </thead>
                <tbody>
                  <?php  // Loop through Order Items and output a row per item
                  foreach (new RecursiveArrayIterator($order->getItems($orderID)) as $record) {
                    if (empty($record["ImgFilename"])) {
                      $fullPath = DEFAULTS["noImgUploaded"];
                    } else {
                      $fullPath = DEFAULTS["productsImgPath"] . $record["ProductID"] . "/" . $record["ImgFilename"];
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
