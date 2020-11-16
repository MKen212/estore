<div class="row"><!--order_header_ADMIN-->
  <div class="col-sm-4"><!--order_information-->
    <h5>Order Information</h5>
    <table class="table table-sm">
      <tr>
        <td><b>Invoice ID:</b></td>
        <td><b><?= $orderDetails["InvoiceID"] ?></b></td>
      </tr>
      <tr>
        <td>Order Status:</td>
        <td><?= statusOutput("OrderStatus", $orderDetails["OrderStatus"], ("admin_dashboard.php?p=orderDetails&id=" . $orderDetails["OrderID"] . "&cur=" . $orderDetails["OrderStatus"] . "&updOrderStatus")) ?></td>
      </tr>
      <tr>
        <td>Record Status:</td>
        <td><?= statusOutput("Status", $orderDetails["Status"], ("admin_dashboard.php?p=orderDetails&id=" . $orderDetails["OrderID"] . "&cur=" . $orderDetails["Status"] . "&updStatus")) ?></td>
      </tr>
      <tr>
        <td>Items / Products:</td>
        <td><?= ($orderDetails["ItemCount"] . " / " . $orderDetails["ProductCount"]) ?></td>
      </tr>
      <tr>
        <td>SubTotal:</td>
        <td><?= symValue($orderDetails["SubTotal"]); ?></td>
      </tr>
      <tr>
        <td>Shipping Cost:</td>
        <td><?= symValue($orderDetails["ShippingCost"]); ?></td>
      </tr>
      <tr>
        <td>Total Value:</td>
        <td><?= symValue($orderDetails["Total"]); ?></td>
      </tr>
      <tr>
        <td>Date/Time Added:</td>
        <td><?= date("d/m/Y @ H:i", strtotime($orderDetails["AddedTimestamp"])) . " by " ?><a class="badge badge-info" href="admin_dashboard.php?p=userDetails&id=<?= $orderDetails["OwnerUserID"] ?>"><?= $orderDetails["OwnerUserID"] ?></a></td>
      </tr>
      <tr>
        <td>Last Edit:</td>
        <td><?= date("d/m/Y @ H:i", strtotime($orderDetails["EditTimestamp"])) . " by " ?><a class="badge badge-info" href="admin_dashboard.php?p=userDetails&id=<?= $orderDetails["EditUserID"] ?>"><?= $orderDetails["EditUserID"] ?></a></td>
      </tr>
    </table>
  </div><!--/order_information-->

  <div class="col-sm-4"><!--shipping_information-->
    <h5>Shipping Information</h5>
    <table class="table table-sm">
      <tr>
        <td>Ship To:</td>
        <td><?= commaToBR($orderDetails["Shipping"]); ?></td>
      </tr>
      <tr>
        <td>Shipping<br />Instructions:</td>
        <td><textarea class="taFixed" rows="3" readonly><?= fixCRLF($orderDetails["ShippingInstructions"]); ?></textarea></td>
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
        <td>Order ID:</td>
        <td><?= $orderDetails["PpOrderID"] ?></td>
      </tr>
      <tr>
        <td>Order Status:</td>
        <td><?= $orderDetails["PpOrderStatus"] ?></td>
      </tr>
      <tr>
        <td>Payment ID:</td>
        <td><?= $orderDetails["PaymentID"] ?></td>
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
        <td>Payer ID:</td>
        <td><?= $orderDetails["PayerID"] ?></td>
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
        <td>Date/Time Paid:</td>
        <td><?= date("d/m/Y @ H:i", strtotime($orderDetails["CaptureTimestamp"])); ?></td>
      </tr>
    </table>
  </div><!--/paypal_information-->
</div><!--order_header_ADMIN-->
