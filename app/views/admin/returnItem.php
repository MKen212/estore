<tr><!--return_item_ADMIN-->
  <td><?= $itemCount; ?></td>
  <td><img width="90" height="83" src="<?= $record["FullPath"] ?>" alt="<?= $record["ImgFilename"]; ?>" /></td>
  <td><?= $record["Name"]; ?><br />ID: <?= $record["ProductID"]; ?></td>
  <td><?= symValue($record["Price"]); ?></td>
  <td><?= $record["QtyReturned"]; ?></td>
  <td><?= statusOutput("ReturnReason", $record["ReturnReason"]); ?></td>
  <td><?= $record["ReceivedTimestamp"] == "0000-00-00 00:00:00" ? "- Pending -" : date("d/m/Y @ H:i", strtotime($record["ReceivedTimestamp"])) . " by " . $record["ReceivedUserID"]; ?></td>
  <td><?= statusOutput("IsReceived", $record["IsReceived"], ("admin_dashboard.php?p=returnDetails&id=" . $record["ReturnID"] . "&itemID=" . $record["ReturnItemID"] . "&cur=" . $record["IsReceived"] . "&updItemIsReceived")) ?></td>
  <td><?= statusOutput("IsAddedToStock", $record["IsAddedToStock"], ("admin_dashboard.php?p=returnDetails&id=" . $record["ReturnID"] . "&itemID=" . $record["ReturnItemID"] . "&cur=" . $record["IsAddedToStock"] . "&updItemIsAddedToStock")) ?></td>
  <td><?= statusOutput("Status", $record["Status"], ("admin_dashboard.php?p=returnDetails&id=" . $record["ReturnID"] . "&itemID=" . $record["ReturnItemID"] . "&cur=" . $record["Status"] . "&updItemStatus")) ?></td>
</tr><!--/return_item_ADMIN-->