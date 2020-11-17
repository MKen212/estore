<tr><!--order_item_ADMIN-->
  <td><?= $record["ItemID"]; ?></td>
  <td>
    <img width="90" height="83" src="<?= $record["FullPath"] ?>" alt="<?= $record["ImgFilename"]; ?>" />
  </td>
  <td>
    <?= $record["Name"]; ?><br />
    ID: <?= $record["ProductID"]; ?>
  </td>
  <td><?= symValue($record["Price"]); ?></td>
  <td><?= $record["QtyOrdered"]; ?></td>
  <td><?= $record["QtyAvailForRtn"]; ?></td>
  <td style="border-left:double">
    <input type="date" name="ordItems[<?= $record["OrderItemID"]; ?>][shippedDate]" value=<?= $record["ShippedDate"]; ?> /><?= " by " . $record["ShippedUserID"]; ?><br />
    <?= date("d/m/Y @ H:i", strtotime($record["EditTimestamp"])) . " by " . $record["EditUserID"]; ?>
  </td>
  <td>
    <?= statusOutput("IsShipped", $record["IsShipped"], ("admin_dashboard.php?p=orderDetails&id=" . $record["OrderID"] . "&itemID=" . $record["OrderItemID"] . "&cur=" . $record["IsShipped"] . "&updItemIsShipped#orderItems")) ?><br />
    <?= statusOutput("Status", $record["Status"], ("admin_dashboard.php?p=orderDetails&id=" . $record["OrderID"] . "&itemID=" . $record["OrderItemID"] . "&cur=" . $record["Status"] . "&updItemStatus#orderItems")) ?>
  </td>
</tr><!--/order_item_ADMIN-->        