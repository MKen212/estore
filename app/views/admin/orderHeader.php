<!-- Order Header Details - ADMIN -->
<div class="row pt-3 pb-2 mb-3 border-bottom">
  <div class="col-6">
    <h2>Order Details - ID: <?= $orderID ?></h2>
  </div>
  <!-- System Messages -->
  <div class="col-6"><?php
    msgShow(); ?>
  </div>
</div><?php

if ($orderRecord == false) :  // Order Record not found ?>
  <div>Order ID not found.</div><?php
else :  // Display Order Header ?>
  <div class="row">
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
          <td><?= statusOutput("OrderStatus", $orderRecord["OrderStatus"], ("admin_dashboard.php?p=orderDetails&id=" . $orderRecord["OrderID"] . "&cur=" . $orderRecord["OrderStatus"] . "&updOrderStatus")) ?></td>
        </tr>
        <tr>
          <td>Record Status:</td>
          <td><?= statusOutput("Status", $orderRecord["Status"], ("admin_dashboard.php?p=orderDetails&id=" . $orderRecord["OrderID"] . "&cur=" . $orderRecord["Status"] . "&updStatus")) ?></td>
        </tr>
        <tr>
          <td>Items / Products:</td>
          <td><?= ($orderRecord["ItemCount"] . " / " . $orderRecord["ProductCount"]) ?></td>
        </tr>
        <tr>
          <td>SubTotal:</td>
          <td><?= symValue($orderRecord["SubTotal"]); ?></td>
        </tr>
        <tr>
          <td>Shipping Cost:</td>
          <td><?= symValue($orderRecord["ShippingCost"]); ?></td>
        </tr>
        <tr>
          <td>Total Value:</td>
          <td><?= symValue($orderRecord["Total"]); ?></td>
        </tr>
        <tr>
          <td>Date/Time Added:</td>
          <td><?= date("d/m/Y @ H:i", strtotime($orderRecord["AddedTimestamp"])) . " by " ?><a class="badge badge-info" href="admin_dashboard.php?p=userDetails&id=<?= $orderRecord["OwnerUserID"] ?>"><?= $orderRecord["OwnerUserID"] ?></a></td>
        </tr>
        <tr>
          <td>Last Edit:</td>
          <td><?= date("d/m/Y @ H:i", strtotime($orderRecord["EditTimestamp"])) . " by " ?><a class="badge badge-info" href="admin_dashboard.php?p=userDetails&id=<?= $orderRecord["EditUserID"] ?>"><?= $orderRecord["EditUserID"] ?></a></td>
        </tr>
      </table>
    </div>

    <!-- Shipping Information -->
    <div class="col-sm-4">
      <h5>Shipping Information</h5>
      <table class="table table-sm">
        <tr>
          <td>Ship To:</td>
          <td><?= commaToBR($orderRecord["Shipping"]); ?></td>
        </tr>
        <tr>
          <td>Shipping<br />Instructions:</td>
          <td>
            <textarea class="taFixed" rows="3" readonly><?php
              if (empty($orderRecord["ShippingInstructions"])) {
                echo "- None -";
              } else {
                echo fixCRLF($orderRecord["ShippingInstructions"]);
              }
            ?></textarea>
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
          <td>Order ID:</td>
          <td><?= $orderRecord["PpOrderID"] ?></td>
        </tr>
        <tr>
          <td>Order Status:</td>
          <td><?= $orderRecord["PpOrderStatus"] ?></td>
        </tr>
        <tr>
          <td>Payment ID:</td>
          <td><?= $orderRecord["PaymentID"] ?></td>
        </tr>
        <tr>
          <td>Payment Status:</td>
          <td><?= $orderRecord["PaymentStatus"] ?></td>
        </tr>
        <tr>
          <td>Payment Value:</td>
          <td><?= $orderRecord["PaymentCurrency"] . " " . $orderRecord["PaymentValue"]?></td>
        </tr>
        <tr>
          <td>Payer ID:</td>
          <td><?= $orderRecord["PayerID"] ?></td>
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
          <td>Date/Time Paid:</td>
          <td><?= date("d/m/Y @ H:i", strtotime($orderRecord["CaptureTimestamp"])); ?></td>
        </tr>
      </table>
    </div>
  </div><?php
endif; ?>