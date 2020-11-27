<!-- Return Items List - ADMIN --><?php
if ($returnRecord == false) :  // Return Record not found ?>
  <div></div><?php
else :  // Display Return Items for Return ?>
  <div class="row" id="returnItems">
    <!-- Return Items -->
    <div class="col-sm-12">
      <h5>Returned Items</h5>
      <div class="table-responsive">
        <form action="admin_dashboard.php?p=returnDetails&id=<?= $returnID; ?>" method="POST" name="retItemsForm" autocomplete="off">
          <table class="table table-striped table-sm" style="margin-bottom:50px">
            <thead>
              <tr>
                <th>Item</th>
                <th>Image</th>
                <th>Product Details</th>
                <th>Unit Price</th>
                <th>Qty</th>
                <th>Reason<br />Action</th>
                <th style="border-left:double">Date Received<br />Date Actioned<br />Last Edit</th>
                <th>Received<br />Actioned<br />Status</th>
              </tr>
            </thead>
            <tbody><?php
              $itemCount = 0;
              foreach ($returnItemsList as $record) :
                $itemCount +=1; ?>
                <tr><!-- Return Item -->
                  <td><?= $itemCount; ?></td>
                  <td>
                    <img width="90" height="83" src="<?= getFilePath($record["ProductID"], $record["ImgFilename"]); ?>" alt="<?= $record["ImgFilename"]; ?>" />
                  </td>
                  <td><?= $record["Name"] . "<br />ID: " . $record["ProductID"]; ?></td>
                  <td><?= symValue($record["Price"]); ?></td>
                  <td><?= $record["QtyReturned"]; ?></td>
                  <td>
                    <?= statusOutput("ReturnReason", $record["ReturnReason"]); ?><br />
                    <?= statusOutput("ReturnAction", $record["ReturnAction"]); ?>
                  </td>
                  <td style="border-left:double">
                    <input type="date" name="retItems[<?= $record["ReturnItemID"]; ?>][receivedDate]" value=<?= $record["ReceivedDate"]; ?> /><?= " by " . $record["ReceivedUserID"]; ?><br />
                    <input type="date" name="retItems[<?= $record["ReturnItemID"]; ?>][actionedDate]" value=<?= $record["ActionedDate"]; ?> /><?= " by " . $record["ActionedUserID"]; ?><br />
                    <?= date("d/m/Y @ H:i", strtotime($record["EditTimestamp"])) . " by " . $record["EditUserID"]; ?>
                  </td>
                  <td>
                    <?= statusOutput("IsReceived", $record["IsReceived"], ("admin_dashboard.php?p=returnDetails&id=" . $record["ReturnID"] . "&itemID=" . $record["ReturnItemID"] . "&cur=" . $record["IsReceived"] . "&updItemIsReceived#returnItems")) ?><br />
                    <?= statusOutput("IsActioned", $record["IsActioned"], ("admin_dashboard.php?p=returnDetails&id=" . $record["ReturnID"] . "&itemID=" . $record["ReturnItemID"] . "&cur=" . $record["IsActioned"] . "&updItemIsActioned#returnItems")) ?><br />
                    <?= statusOutput("Status", $record["Status"], ("admin_dashboard.php?p=returnDetails&id=" . $record["ReturnID"] . "&itemID=" . $record["ReturnItemID"] . "&cur=" . $record["Status"] . "&updItemStatus#returnItems")) ?>
                  </td>
                </tr><?php
              endforeach; ?>

              <tr><!-- Update Return Button -->
                <td colspan="6"></td>
                <td colspan="2" style="border-left:double">
                  <button class="btn btn-primary" style="margin-top:10px" type="submit" name="updateReturn">Update Return</button>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div><?php
endif; ?>