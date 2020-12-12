<!-- Order Items List - ADMIN --><?php
if ($orderRecord == false) :  // Order Record not found ?>
  <div></div><?php
else :  // Display Order Items for Order ?>
  <div class="row" id="orderItems">
    <!-- Order Items -->
    <div class="col-sm-12">
      <h5>Ordered Items</h5>
      <div class="table-responsive">
        <form action="admin_dashboard.php?p=orderDetails&id=<?= $orderID ?>" method="post" name="ordItemsForm" autocomplete="off">
          <table class="table table-striped table-sm" style="margin-bottom:50px">
            <thead>
              <tr>
                <th>Item</th>
                <th>Image</th>
                <th>Product Details</th>
                <th>Unit Price</th>
                <th>Qty</th>
                <th>Qty Avail<br />For Return</th>
                <th style="border-left:double">Date Shipped<br />Last Edit</th>
                <th>Shipped<br />Item Status</th>
              </tr>
            </thead>
            <tbody><?php
              if (empty($orderItemList)) :  // No Order Item Records Found ?>
                <tr>
                  <td colspan="6">No Items to Display</td>
                  <td style="border-left:double" colspan="2"></td>
                </tr><?php
              else :
                foreach ($orderItemList as $record) : ?>
                  <tr><!-- Order Item -->
                    <td><?= $record["ItemID"] ?></td>
                    <td>
                      <img width="90" height="83" src="<?= getFilePath($record["ProductID"], $record["ImgFilename"]) ?>" alt="<?= $record["ImgFilename"] ?>" />
                    </td>
                    <td><?= $record["Name"] . "<br />ID: " . $record["ProductID"] ?></td>
                    <td><?= symValue($record["Price"]) ?></td>
                    <td><?= $record["QtyOrdered"] ?></td>
                    <td><?= $record["QtyAvailForRtn"] ?></td>
                    <td style="border-left:double">
                      <input type="date" name="ordItems[<?= $record["OrderItemID"] ?>][shippedDate]" value=<?= $record["ShippedDate"] ?> /><?= " by " . $record["ShippedUserID"] ?><br /><?= date("d/m/Y @ H:i", strtotime($record["EditTimestamp"])) . " by " . $record["EditUserID"] ?></td>
                    <td>
                      <?= statusOutput("IsShipped", $record["IsShipped"], ("admin_dashboard.php?p=orderDetails&id=" . $record["OrderID"] . "&itemID=" . $record["OrderItemID"] . "&cur=" . $record["IsShipped"] . "&updItemIsShipped#orderItems")) ?><br />
                      <?= statusOutput("Status", $record["Status"], ("admin_dashboard.php?p=orderDetails&id=" . $record["OrderID"] . "&itemID=" . $record["OrderItemID"] . "&cur=" . $record["Status"] . "&updItemStatus#orderItems")) ?>
                    </td>
                  </tr><?php
                endforeach;
              endif; ?>

              <tr><!-- Update Order Button -->
                <td colspan="6"></td>
                <td colspan="2" style="border-left:double">
                  <button class="btn btn-primary" style="margin-top:10px" type="submit" name="updateOrder">Update Order</button>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div><?php
endif; ?>