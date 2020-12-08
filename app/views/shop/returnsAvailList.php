<!-- Returns Available List - SHOP -->
<section id="cart_items">
  <div class="container">
    <!-- Title Block -->
    <div class="row">
      <div class="col-sm-12 bg">
        <h2 class="title text-center">Returns Available</h2>
      </div>
    </div><?php

    if (empty($refData)) :  // Order Record not found ?>
      <div class="row register-req">
        <p>Order ID '<?= $orderID ?>' not found.</p>
      </div><?php
    elseif ($isOwner != true) : // Order is not owned by current user ?>
      <div class="row register-req">
        <p>Sorry - You do not have access to Order ID '<?= $orderID ?>' for Invoice ID '<?= $refData["InvoiceID"] ?>'.</p>
      </div><?php
    elseif ($isActive != true) :  // Order is not Active ?>
      <div class="row register-req">
        <p>Sorry - Order ID '<?= $orderID ?>' for Invoice ID '<?= $refData["InvoiceID"] ?>' is marked as 'Inactive'.</p>
      </div><?php
    else :  // Display Returns Available ?>
      <!-- Return Items Available List - SHOP -->
      <div class="row">
        <div class="table-responsive" style="margin-bottom:75px">
          <p >The following lists all items shipped in the last <?= DEFAULTS["returnsAllowance"] ?> days that are available for return against <b>Invoice ID '<?= $refData["InvoiceID"] ?>'</b>:</p>
          <hr />
          <form action="index.php?p=returnConfirmation" method="post" name="retAvailForm" autocomplete="off">
            <input type="hidden" name="orderID" value="<?= $orderID ?>" />
            <input type="hidden" name="invoiceID" value="<?= $refData["InvoiceID"] ?>" />
            <input type="hidden" name="paymentID" value="<?= $refData["PaymentID"] ?>" />
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Item</th>
                  <th>Image</th>
                  <th>Product Details</th>
                  <th>Unit Price</th>
                  <th>Date Shipped</th>
                  <th style="border-left:double">Return?</th>
                  <th>Quantity</th>
                  <th>Reason</th>
                  <th>Action Requested</th>
                </tr>
              </thead>
              <tbody><?php
                if (empty($returnsAvailList)) :  // No Items for Return Found ?>
                  <tr>
                    <td colspan ="5">Sorry - There are no items available for return for this order.</td>
                    <td colspan="4" style="border-left:double"></td>
                  </tr><?php
                else :
                  $itemCount = 0;
                  foreach ($returnsAvailList as $record) :
                    $itemCount ++; ?>
                    <tr><!-- Returns Available Item-->
                      <td><?= $itemCount ?></td>
                      <td>
                        <img width="90" height="83" src="<?= getFilePath($record["ProductID"], $record["ImgFilename"]) ?>" alt="<?= $record["ImgFilename"] ?>" />
                      </td>
                      <td><b><?= $record["Name"] ?></b><br />Product ID: <?= $record["ProductID"] ?></td>
                      <td><?= symValue($record["Price"]) ?></td>
                      <td ><?= date("d/m/Y", strtotime($record["ShippedDate"])) ?></td>
                      <td style="border-left:double">
                        <input type="checkbox" name="returns[<?= $itemCount ?>][orderItemID]" value="<?= $record["OrderItemID"] ?>" />
                        <input type="hidden" name="returns[<?= $itemCount ?>][price]" value="<?= $record["Price"] ?>" />
                      </td>
                      <td>
                        <input type="number" name="returns[<?= $itemCount ?>][qtyReturned]" value="<?= $record["QtyAvailForRtn"] ?>" min="1" max="<?= $record["QtyAvailForRtn"] ?>" />
                      </td>
                      <td>
                        <select name="returns[<?= $itemCount ?>][returnReason]"><?php
                          statusOptions("ReturnReason", 0); ?>
                        </select>
                      </td>
                      <td>
                        <select name="returns[<?= $itemCount ?>][returnAction]"><?php
                          statusOptions("ReturnAction", 0); ?>
                        </select>
                      </td>
                    </tr><?php
                  endforeach;                    
                  if ($itemCount > 0) : ?>
                    <td colspan="5" style="text-align:right; padding-top:10px">Tick the items to return, update the quantities being returned, the reason for<br />their return and the action requested, and then click:</td>
                    <td colspan="4" style="border-left:double">
                      <button class="btn btn-primary" style="margin-top:5px" type="submit" name="selectReturns">Return Selected Items</button>
                    </td><?php
                  endif;
                endif; ?>
              </tbody>
            </table>
          </form>
        </div>
      </div><?php
    endif; ?>
  </div>
</section>