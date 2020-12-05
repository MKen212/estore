<!-- Return Details - SHOP -->
<section id="cart_items">
  <div class="container">
    <!-- Title Block -->
    <div class="row">
      <div class="col-sm-12 bg">
        <h2 class="title text-center">Return Details</h2>
      </div>
    </div>

    <!-- System Messages -->
    <div class="row"><?php
      msgShow();  // Show any system messages coming from orderConfirmation ?>
    </div><?php
      if (empty($refData)) :  // Returns Record not found ?>
        <div class="row register-req">
          <p>Return ID not found.</p>
        </div><?php
      elseif ($isOwner != true) : // Return is not owned by current user ?>
        <div class="row register-req">
          <p>Sorry - You do not have access to Return ID '<?= $returnID ?>' for Invoice ID '<?= $refData["InvoiceID"] ?>'.</p>
        </div><?php
      elseif ($isActive != true) :  // Return is not Active ?>
        <div class="row register-req">
          <p>Sorry - Return ID '<?= $returnID ?>' for Invoice ID '<?= $refData["InvoiceID"] ?>' is marked as 'Inactive'.</p>
        </div><?php
      else :  // Display Return Header ?>
        <!-- Returns Header - SHOP -->
        <div class="shopper-info">
          <div class="row">
            <!-- Returns Information -->
            <div class="col-sm-4">
              <h5>Returns Information</h5>
              <table class="table table-sm">
                <tr>
                  <td><b>Returns Ref:</b></td>
                  <td><b><?= returnRef($returnRecord["InvoiceID"], $returnRecord["ReturnID"]) ?></b></td>
                </tr>
                <tr>
                  <td>Invoice ID:</td>
                  <td><?= $returnRecord["InvoiceID"] ?></td>
                </tr>
                <tr>
                  <td>Return Status:</td>
                  <td><?= statusOutputShop("ReturnStatus", $returnRecord["ReturnStatus"]) ?></td>
                </tr>
                <tr>
                  <td>Number of Items:</td>
                  <td><?= $returnRecord["ItemCount"] ?></td>
                </tr>
                <tr>
                  <td>Number of Products:</td>
                  <td><?= $returnRecord["ProductCount"] ?></td>
                </tr>
                <tr>
                  <td>Total Refund Value:</td>
                  <td><?= symValue($returnRecord["RefundTotal"]) ?></td>
                </tr>
                <tr>
                  <td>Date & Time Requested:</td>
                  <td><?= date("d/m/Y @ H:i", strtotime($returnRecord["AddedTimestamp"])) ?></td>
                </tr>
              </table>
            </div>

            <!-- Shipping Information -->
            <div class="col-sm-4">
              <h5>Shipping Information</h5>
              <table class="table table-sm">
                <tr>
                  <td colspan="2">Returned goods should be packaged securely and sent to the address below.</td>
                </tr>
                <tr>
                  <td>Returns Address:</td>
                  <td><?= commaToBR(DEFAULTS["returnsAddress"]) ?></td>
                </tr>
                <tr>
                  <td colspan="2">Please include the '<b>Returns Ref</b>' code on the label.</td>
                </tr>
              </table>
            </div>

            <!-- PayPal Information -->
            <div class="col-sm-4">
              <h5>PayPal Information</h5>
              <table class="table table-sm"><?php
                if ($returnRecord["RefundTotal"] == 0) : ?>
                  <tr>
                    <td>No PayPal Refund to process.</td>
                  </tr><?php
                elseif (empty($returnRecord["PpRefundID"])) : ?>
                  <tr>
                    <td>PayPal Refund not yet processed.</td>
                  </tr><?php
                else : ?>
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
          </div>
        </div>

        <!-- Return Items -->
        <div class="row" style="margin-bottom:50px">
          <div class="col-sm-12 shopper-info">
            <h5>Returned Items</h5>
            <div class="table-responsive cart_info">
              <table class="table table-condensed" style="margin-bottom:0px">
                <thead>
                  <tr class="cart_menu">
                    <td class="image">Item</td>
                    <td class="description"></td>
                    <td class="price">Unit Price</td>
                    <td class="quantity">Quantity</td>
                    <td class="total">Item Total</td>
                    <td>Reason<br/>Action</td>
                    <td>Date Received<br/>Date Actioned</td>
                  </tr>
                </thead>
                <tbody><?php
                  if (empty($returnItemList)) :  // No Return Item Records Found ?>
                    <tr>
                      <td colspan ='7'>No Items to Display</td>
                    </tr><?php
                  else :
                    foreach ($returnItemList as $record) {
                      include "../app/views/shop/returnItem.php";
                    } ?>
                    <!-- Return Item Totals -->
                    <tr class="cart_menu"><!--returnItemTotals_SHOP-->
                      <td></td>
                      <td class="description">
                        <h4>Sub-Totals:</h4>
                      </td>
                      <td class="price">
                        <h4><?= $returnRecord["ItemCount"] ?> Item(s)</h4>
                      </td>
                      <td class="quantity">
                        <input class="cart_quantity_input" type="text" name="quantity" value="<?= $returnRecord["ProductCount"] ?>"  size="2" readonly />
                      </td>
                      <td class="total">
                        <h4><?= symValue($returnRecord["RefundTotal"]) ?></h4>
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
  </div>
</section>