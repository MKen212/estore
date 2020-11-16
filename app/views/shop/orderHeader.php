<div class="shopper-info"><!--order_header_SHOP-->
  <div class="col-sm-4"><!--order_information-->
    <h5>Order Information</h5>
    <table class="table table-sm">
      <tr>
        <td><b>Invoice ID:</b></td>
        <td><b><?= $orderDetails["InvoiceID"] ?></b></td>
      </tr>
      <tr>
        <td>Order Status:</td>
        <td><?= statusOutputShop("OrderStatus", $orderDetails["OrderStatus"]) ?></td>
      </tr>
      <tr>
        <td>Number of Items:</td>
        <td><?= $orderDetails["ItemCount"] ?></td>
      </tr>
      <tr>
        <td>Number of Products:</td>
        <td><?= $orderDetails["ProductCount"] ?></td>
      </tr>
      <tr>
        <td>SubTotal:</td>
        <td><?= symValue($orderDetails["SubTotal"]) ?></td>
      </tr>
      <tr>
        <td>Shipping Cost:</td>
        <td><?= symValue($orderDetails["ShippingCost"]) ?></td>
      </tr>
      <tr>
        <td>Total Value:</td>
        <td><?= symValue($orderDetails["Total"]) ?></td>
      </tr>
      <tr>
        <td>Date & Time Placed:</td>
        <td><?= date("d/m/Y @ H:i", strtotime($orderDetails["CreateTimestamp"])) ?></td>
      </tr>
    </table>
  </div><!--/order_information-->

  <div class="col-sm-4"><!--shipping_information-->
    <h5>Shipping Information</h5>
    <table class="table table-sm">
      <tr>
        <td>Ship To:</td
        ><td><?= commaToBR($orderDetails["Shipping"]); ?></td>
      </tr>
      <tr>
        <td>Shipping<br />Instructions:</td>
        <td><textarea rows="3" readonly><?= fixCRLF($orderDetails["ShippingInstructions"]); ?></textarea></td>
      </tr>
      <tr>
        <td>Weight:</td>
        <td><?= $orderDetails["ShippingWeightKG"] ?> kg</td>
      </tr>
      <tr>
        <td>Priority:</td>
        <td><?= $orderDetails["ShippingType"] ?></td>
      </tr>
    </table>
  </div><!--/shipping_information-->

  <div class="col-sm-4"><!--paypal_information-->
    <h5>PayPal Information</h5>
    <table class="table table-sm">
      <tr>
        <td>Order Status:</td>
        <td><?= $orderDetails["PpOrderStatus"] ?></td>
      </tr>
      <tr>
        <td>Payment Status:</td>
        <td><?= $orderDetails["PaymentStatus"] ?></td>
      </tr>
      <tr>
        <td>Payment Value:</td>
        <td><?= $orderDetails["PaymentCurrency"] . " " . $orderDetails["PaymentValue"]?></td>
      </tr>
      <tr>
        <td>Payer Name:</td>
        <td><?= $orderDetails["PayerName"] ?></td>
      </tr>
      <tr>
        <td>Payer Email:</td>
        <td><?= $orderDetails["PayerEmail"] ?></td>
      </tr>
      <tr>
        <td>Date & Time Paid:</td>
        <td><?= date("d/m/Y @ H:i", strtotime($orderDetails["CaptureTimestamp"])); ?></td>
      </tr>
    </table>
  </div><!--/paypal_information-->
</div><!--/order_header_SHOP-->