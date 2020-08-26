<?php  // Shop - Order Details
if (empty($_SESSION["invoiceID"])) :  // Check Invoice ID Provided ?>
  <div style="margin-bottom:50px">No Invoice ID provided.</div>
<?php else :
  include_once "../app/models/orderClass.php";
  $order = new Order();

  // Get Order Details
  $orderDetails = $order->getDetails($_SESSION["invoiceID"]);
  // Update Status Code to Text
  $orderDetails["Status"] = ordStatusText($orderDetails["Status"]);
  // Update Shipping Instructions if none
  if (empty($orderDetails["ShippingInstructions"])) $orderDetails["ShippingInstructions"] = "-None-";

  // Show Details in Order Header
  include "../app/views/shop/orderHeader.php";

  // Show Order Items
  ?>
  <div class="row"><!--order_items-->
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
            </tr>
          </thead>
          <tbody>
            <?php  // Loop through Order Items and output a row per item
            $orderID = $orderDetails["OrderID"];
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
<?php endif; ?>
