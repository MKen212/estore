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
    <?php if ($record["ShippedDate"] == "0000-00-00") : 
      echo "- Pending - <br />";
    else: ?>
      <form action="admin_dashboard.php?p=orderDetails&id=<?= $record["OrderID"]; ?>&itemID=<?=$record["OrderItemID"]; ?>&updShippedDate" method="POST">
        <input type="date" name="newShipDate" value=<?= $record["ShippedDate"]; ?> />
        <input type="submit" name="updShipDate" value="Update" />
        <?= " by " . $record["ShippedUserID"]; ?>
      </form>
    <?php endif; ?>
    <?= date("d/m/Y @ H:i", strtotime($record["EditTimestamp"])) . " by " . $record["EditUserID"]; ?>
  </td>
  <td>
    <?= statusOutput("IsShipped", $record["IsShipped"], ("admin_dashboard.php?p=orderDetails&id=" . $record["OrderID"] . "&itemID=" . $record["OrderItemID"] . "&cur=" . $record["IsShipped"] . "&updItemIsShipped")) ?><br />
    <?= statusOutput("Status", $record["Status"], ("admin_dashboard.php?p=orderDetails&id=" . $record["OrderID"] . "&itemID=" . $record["OrderItemID"] . "&cur=" . $record["Status"] . "&updItemStatus")) ?>
  </td>
</tr><!--/order_item_ADMIN-->