<div class="shopper-info"><!--returns_header_SHOP-->
  <div class="col-sm-4"><!--returns_information-->
    <h5>Returns Information</h5>
    <table class="table table-sm">
      <tr>
        <td><b>Returns Ref:</b></td>
        <td><b><?= $returnDetails["ReturnsRef"] ?></b></td>
      </tr>
      <tr>
        <td>Invoice ID:</td>
        <td><?= $returnDetails["InvoiceID"] ?></td>
      </tr>
      <tr>
        <td>Return Status:</td>
        <td><?= statusOutputShop("ReturnStatus", $returnDetails["ReturnStatus"]) ?></td>
      </tr>
      <tr>
        <td>Number of Items:</td>
        <td><?= $returnDetails["ItemCount"] ?></td>
      </tr>
      <tr>
        <td>Number of Products:</td>
        <td><?= $returnDetails["ProductCount"] ?></td>
      </tr>
      <tr>
        <td>Total Refund Value:</td>
        <td><?= symValue($returnDetails["RefundTotal"]) ?></td>
      </tr>
      <tr>
        <td>Date & Time Requested:</td>
        <td><?= date("d/m/Y @ H:i", strtotime($returnDetails["AddedTimestamp"])) ?></td>
      </tr>
    </table>
  </div><!--/returns_information-->

  <div class="col-sm-4"><!--shipping_information-->
    <h5>Shipping Information</h5>
    <table class="table table-sm">
      <tr>
        <td colspan="2">Returned goods should be packaged securely and sent to the address below.</td>
      </tr>
      <tr>
        <td>Returns Address:</td>
        <td><?= commaToBR(DEFAULTS["returnsAddress"]); ?></td>
      </tr>
      <tr>
        <td colspan="2">Please include the '<b>Returns Ref</b>' code on the label.</td>
      </tr>
    </table>
  </div><!--/shipping_information-->

  <div class="col-sm-4"><!--paypal_information-->
    <h5>PayPal Information</h5>
    <table class="table table-sm">
      <?php if ($returnDetails["RefundTotal"] == 0) : ?>
        <tr>
          <td>No PayPal Refund to process.</td>
        </tr>
      <?php elseif (empty($returnDetails["PpRefundID"])) : ?>
        <tr>
          <td>PayPal Refund not yet processed.</td>
        </tr>
      <?php else : ?>
        <tr>
          <td>Refund Status:</td>
          <td><?= $returnDetails["PpRefundStatus"] ?></td>
        </tr>
        <tr>
          <td>Refund Value:</td>
          <td><?= $returnDetails["CurrencyCode"] . " " . $returnDetails["Value"] ?></td>
        </tr>
        <tr>
          <td>Date & Time Refunded:</td>
          <td><?= date("d/m/Y @ H:i", strtotime($returnDetails["RefundTimestamp"])); ?></td>
        </tr>
      <?php endif; ?>
    </table>
  </div><!--/paypal_information-->
</div><!--/returns_header_SHOP-->
