<div class="row"><!--returns_header_ADMIN-->
  <div class="col-sm-6"><!--returns_information-->
    <h5>Returns Information</h5>
    <table class="table table-sm">
      <tr>
        <td><b>Returns Ref:</b></td>
        <td><b><?= $returnDetails["ReturnsRef"] ?></b></td>
      </tr>
      <tr>
        <td>Invoice ID:</td>
        <td><a class="badge badge-info" href="admin_dashboard.php?p=orderDetails&id=<?= $returnDetails["OrderID"] ?>"><?= $returnDetails["InvoiceID"] ?></a></td>
      </tr>
      <tr>
        <td>Return Status:</td>
        <td><?= statusOutput("ReturnStatus", $returnDetails["ReturnStatus"], ("admin_dashboard.php?p=returnDetails&id=" . $returnDetails["ReturnID"] . "&cur=" . $returnDetails["ReturnStatus"] . "&updReturnStatus")) ?></td>
      </tr>
      <tr>
        <td>Record Status:</td>
        <td><?= statusOutput("Status", $returnDetails["Status"], ("admin_dashboard.php?p=returnDetails&id=" . $returnDetails["ReturnID"] . "&cur=" . $returnDetails["Status"] . "&updStatus")) ?></td>
      </tr>
      <tr>
        <td>Items / Products:</td>
        <td><?= ($returnDetails["ItemCount"] . " / " . $returnDetails["ProductCount"]) ?></td>
      </tr>
      <tr>
        <td>Total Refund Value:</td>
        <td><?= symValue($returnDetails["RefundTotal"]); ?> <a class="badge badge-primary" style="margin-left:15px" href="admin_dashboard.php?p=returnDetails&id=<?= $returnDetails["ReturnID"] ?>&refund">Process Refund</a></td>
      </tr>
      <tr>
        <td>Date/Time Added:</td>
        <td><?= date("d/m/Y @ H:i", strtotime($returnDetails["AddedTimestamp"])) . " by " ?><a class="badge badge-info" href="admin_dashboard.php?p=userDetails&id=<?= $returnDetails["OwnerUserID"] ?>"><?= $returnDetails["OwnerUserID"] ?></a></td>
      </tr>
      <tr>
        <td>Last Edit:</td>
        <td><?= date("d/m/Y @ H:i", strtotime($returnDetails["EditTimestamp"])) . " by " ?><a class="badge badge-info" href="admin_dashboard.php?p=userDetails&id=<?= $returnDetails["EditUserID"] ?>"><?= $returnDetails["EditUserID"] ?></a></td>
      </tr>
    </table>
  </div><!--/returns_information-->

  <div class="col-sm-6"><!--paypal_information-->
    <h5>PayPal Information</h5>
    <table class="table table-sm">
      <tr>
        <td>Original Payment ID:</td>
        <td><?= $returnDetails["PaymentID"] ?></td>
      </tr>
    </table>
  </div><!--/paypal_information-->
</div><!--/returns_header_ADMIN-->