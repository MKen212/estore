<!-- Returns Header Details - ADMIN -->
<div class="row pt-3 pb-2 mb-3 border-bottom">
  <div class="col-6">
    <h2>Return Details - ID: <?= $returnID ?></h2>
  </div>
  <!-- System Messages -->
  <div class="col-6">
    <?php msgShow(); ?>
  </div>
</div><?php

if (empty($returnRecord)) :  // Return Record not found ?>
  <div>Return ID not found.</div><?php
else :  // Display Return Header ?>
  <div class="row">
    <!-- Return Information -->
    <div class="col-sm-6">
      <h5>Return Information</h5>
      <table class="table table-sm">
        <tr>
          <td><b>Return Ref:</b></td>
          <td><b><?= returnRef($returnRecord["InvoiceID"], $returnRecord["ReturnID"]) ?></b></td>
        </tr>
        <tr>
          <td>Invoice ID:</td>
          <td><a class="badge badge-info" href="admin_dashboard.php?p=orderDetails&id=<?= $returnRecord["OrderID"] ?>"><?= $returnRecord["InvoiceID"] ?></a></td>
        </tr>
        <tr>
          <td>Return Status:</td>
          <td><?= statusOutput("ReturnStatus", $returnRecord["ReturnStatus"], ("admin_dashboard.php?p=returnDetails&id=" . $returnRecord["ReturnID"] . "&cur=" . $returnRecord["ReturnStatus"] . "&updReturnStatus")) ?></td>
        </tr>
        <tr>
          <td>Record Status:</td>
          <td><?= statusOutput("Status", $returnRecord["Status"], ("admin_dashboard.php?p=returnDetails&id=" . $returnRecord["ReturnID"] . "&cur=" . $returnRecord["Status"] . "&updStatus")) ?></td>
        </tr>
        <tr>
          <td>Items / Products:</td>
          <td><?= ($returnRecord["ItemCount"] . " / " . $returnRecord["ProductCount"]) ?></td>
        </tr>
        <tr>
          <td>Total Refund Value:</td>
          <td><?= symValue($returnRecord["RefundTotal"]) ?><?php
            // Only show Process Refund Button if return has value, is not already processed, has a ReturnStatus of Submitted and a Status of Active
            if (($returnRecord["RefundTotal"] > 0) && empty($returnRecord["PpRefundID"]) && ($returnRecord["ReturnStatus"] == 1) && ($returnRecord["Status"] == 1)) :  ?>
              <a class="badge badge-primary" style="margin-left:15px" href="admin_dashboard. php?p=returnDetails&id=<?= $returnRecord["ReturnID"] ?>&invId=<?= $returnRecord["InvoiceID"] ?>&payId=<?= $returnRecord["PaymentID"] ?>&value=<?= $returnRecord["RefundTotal"] ?>&refund">Process Refund</a><?php
            endif; ?>
          </td>
        </tr>
        <tr>
          <td>Date/Time Added:</td>
          <td><?= date("d/m/Y @ H:i", strtotime($returnRecord["AddedTimestamp"])) . " by " ?><a class="badge badge-info" href="admin_dashboard.php?p=userDetails&id=<?= $returnRecord["OwnerUserID"] ?>"><?= $returnRecord["OwnerUserID"] ?></a></td>
        </tr>
        <tr>
          <td>Last Edit:</td>
          <td><?= date("d/m/Y @ H:i", strtotime($returnRecord["EditTimestamp"])) . " by " ?><a class="badge badge-info" href="admin_dashboard.php?p=userDetails&id=<?= $returnRecord["EditUserID"] ?>"><?= $returnRecord["EditUserID"] ?></a></td>
        </tr>
      </table>
    </div>

    <!-- PayPal Information -->
    <div class="col-sm-6">
      <h5>PayPal Information</h5>
      <table class="table table-sm">
        <tr>
          <td>Original Payment ID:</td>
          <td><?= $returnRecord["PaymentID"] ?></td>
        </tr><?php
        if (!empty($returnRecord["PpRefundID"])) : ?>
          <tr>
            <td>Refund ID:</td>
            <td><?= $returnRecord["PpRefundID"] ?></td>
          </tr>
          <tr>
            <td>Refund Status:</td>
            <td><?= $returnRecord["PpRefundStatus"] ?></td>
          </tr>
          <tr>
            <td>Refund Value:</td>
            <td><?= $returnRecord["CurrencyCode"] . " " . $returnRecord["Value"] ?></td>
          </tr>
          <tr>
            <td>Date & Time Refunded:</td>
            <td><?= date("d/m/Y @ H:i", strtotime($returnRecord["RefundTimestamp"])) ?></td>
          </tr><?php
        endif; ?>
      </table>
    </div>
  </div><?php
endif; ?>