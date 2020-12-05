<!-- Order Details - SHOP -->
<section id="cart_items">
  <div class="container">
    <!-- Title Block -->
    <div class="row">
      <div class="col-sm-12 bg">
        <h2 class="title text-center">Order Details</h2>
      </div>
    </div>

    <!-- System Messages -->
    <div class="row"><?php
      msgShow();  // Show any system messages coming from orderConfirmation ?>
    </div><?php
    if (empty($refData)) :  // Order Record not found ?>
      <div class="row register-req">
        <p>Order ID not found.</p>
      </div><?php
    elseif ($isOwner != true) : // Order is not owned by current user ?>
      <div class="row register-req">
        <p>Sorry - You do not have access to Order ID '<?= $orderID ?>' for Invoice ID '<?= $refData["InvoiceID"] ?>'.</p>
      </div><?php
    elseif ($isActive != true) :  // Order is not Active ?>
      <div class="row register-req">
        <p>Sorry - Order ID '<?= $orderID ?>' for Invoice ID '<?= $refData["InvoiceID"] ?>' is marked as 'Inactive'.</p>
      </div><?php
    else :  // Display Order Header ?>
      <!-- Order Header -->
      <div class="row">
        <div class="shopper-info">
          <!-- Order Information -->
          <div class="col-sm-4">
            <h5>Order Information</h5>
            <table class="table table-sm">
              <tr>
                <td><b>Invoice ID:</b></td>
                <td><b><?= $orderRecord["InvoiceID"] ?></b></td>
              </tr>
              <tr>
                <td>Order Status:</td>
                <td><?= statusOutputShop("OrderStatus", $orderRecord["OrderStatus"]) ?></td>
              </tr>
              <tr>
                <td>Number of Items:</td>
                <td><?= $orderRecord["ItemCount"] ?></td>
              </tr>
              <tr>
                <td>Number of Products:</td>
                <td><?= $orderRecord["ProductCount"] ?></td>
              </tr>
              <tr>
                <td>SubTotal:</td>
                <td><?= symValue($orderRecord["SubTotal"]) ?></td>
              </tr>
              <tr>
                <td>Shipping Cost:</td>
                <td><?= symValue($orderRecord["ShippingCost"]) ?></td>
              </tr>
              <tr>
                <td>Total Value:</td>
                <td><?= symValue($orderRecord["Total"]) ?></td>
              </tr>
              <tr>
                <td>Date & Time Placed:</td>
                <td><?= date("d/m/Y @ H:i", strtotime($orderRecord["CreateTimestamp"])) ?></td>
              </tr>
            </table>
          </div>

          <!-- Shipping Information -->
          <div class="col-sm-4">
            <h5>Shipping Information</h5>
            <table class="table table-sm">
              <tr>
                <td>Ship To:</td
                ><td><?= commaToBR($orderRecord["Shipping"]) ?></td>
              </tr>
              <tr>
                <td>Shipping<br />Instructions:</td>
                <td>
                  <textarea rows="3" readonly><?php
                    if (empty($orderRecord["ShippingInstructions"])) {
                      echo "- None -";
                    } else {
                      echo fixCRLF($orderRecord["ShippingInstructions"]);
                    } ?>
                  </textarea>
                </td>
              </tr>
              <tr>
                <td>Weight:</td>
                <td><?= $orderRecord["ShippingWeightKG"] ?> kg</td>
              </tr>
              <tr>
                <td>Priority:</td>
                <td><?= $orderRecord["ShippingType"] ?></td>
              </tr>
            </table>
          </div>

          <!-- PayPal Information -->
          <div class="col-sm-4">
            <h5>PayPal Information</h5>
            <table class="table table-sm">
              <tr>
                <td>Order Status:</td>
                <td><?= $orderRecord["PpOrderStatus"] ?></td>
              </tr>
              <tr>
                <td>Payment Status:</td>
                <td><?= $orderRecord["PaymentStatus"] ?></td>
              </tr>
              <tr>
                <td>Payment Value:</td>
                <td><?= $orderRecord["PaymentCurrency"] . " " . $orderRecord["PaymentValue"] ?></td>
              </tr>
              <tr>
                <td>Payer Name:</td>
                <td><?= $orderRecord["PayerName"] ?></td>
              </tr>
              <tr>
                <td>Payer Email:</td>
                <td><?= $orderRecord["PayerEmail"] ?></td>
              </tr>
              <tr>
                <td>Date & Time Paid:</td>
                <td><?= date("d/m/Y @ H:i", strtotime($orderRecord["CaptureTimestamp"])) ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>

      <!-- Order Items -->
      <div class="row" style="margin-bottom:50px">
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
              <tbody><?php
                if (empty($orderItemList)) :  // No Order Item Records Found ?>
                  <tr>
                    <td colspan ='7'>No Items to Display</td>
                  </tr><?php
                else :
                  foreach ($orderItemList as $record) {
                    include "../app/views/shop/orderItem.php";
                  } ?>
                  <!-- Order Item Totals -->
                  <tr class="cart_menu">
                    <td></td>
                    <td class="description">
                      <h4>Sub-Totals:</h4>
                    </td>
                    <td class="price">
                      <h4><?= $orderRecord["ItemCount"] ?> Item(s)</h4>
                    </td>
                    <td class="quantity">
                      <input class="cart_quantity_input" type="text" name="quantity" value="<?= $orderRecord["ProductCount"] ?>"  size="2" readonly />
                    </td>
                    <td class="total">
                      <h4><?= symValue($orderRecord["SubTotal"]) ?></h4>
                    </td>
                    <td></td>
                    <td></td>
                  </tr><?php
                endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div><?php
    endif; ?>
  </div>
</section>