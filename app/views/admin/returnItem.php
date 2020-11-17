<tr><!--return_item_ADMIN-->
  <td><?= $itemCount; ?></td>
  <td>
    <img width="90" height="83" src="<?= $record["FullPath"] ?>" alt="<?= $record["ImgFilename"]; ?>" />
  </td>
  <td>
    <?= $record["Name"]; ?><br />
    ID: <?= $record["ProductID"]; ?>
  </td>
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
</tr><!--/return_item_ADMIN-->