<tr><!--order_item_ADMIN-->
  <td><?= $record["ItemID"]; ?></td>
  <td><?= $record["ProductID"]; ?></td>
  <td><img width="90" height="83" src="<?= $record["FullPath"] ?>" alt="<?= $record["ImgFilename"]; ?>" /></td>
  <td><?= $record["Name"]; ?></td>
  <td><?= $record["Price"]; ?></td>
  <td><?= $record["QtyOrdered"]; ?></td>
  <td><?= $record["ShippedTimestamp"] == "0000-00-00 00:00:00" ? "- Pending -" : date("d/m/Y @ H:i", strtotime($record["ShippedTimestamp"])) . " by " . $record["ShippedUserID"]; ?></td>
  <td><?= statusOutput("IsShipped", $record["IsShipped"], ("admin_dashboard.php?p=orderDetails&id=" . $record["OrderID"] . "&itemID=" . $record["OrderItemID"] . "&cur=" . $record["IsShipped"] . "&updItemIsShipped")) ?></td>
  <td><?= statusOutput("Status", $record["Status"], ("admin_dashboard.php?p=orderDetails&id=" . $record["OrderID"] . "&itemID=" . $record["OrderItemID"] . "&cur=" . $record["Status"] . "&updItemStatus")) ?></td>
</tr><!--/order_item_ADMIN-->