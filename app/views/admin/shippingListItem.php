<tr><!--shipping_list_item_ADMIN-->
  <td><?= $record["ShippingID"]; ?></td>
  <td><a href="admin_dashboard.php?p=shippingDetails&id=<?= $record["ShippingID"]; ?>"><?= $record["ShippingRef"]; ?></a></td>
  <td><?= $record["Band"]; ?></td>
  <td><?= $record["Type"]; ?></td>
  <td><?= $record["PriceBandKG"]; ?></td>
  <td><?= $record["PriceBandCost"]; ?></td>
  <td><?= date("d/m/Y @ H:i", strtotime($record["EditTimestamp"])) . " by " . $record["EditUserID"]; ?></td>
  <td><?= statusOutput("Status", $record["Status"], ("admin_dashboard.php?p=shipping&id=" . $record["ShippingID"] . "&cur=" . $record["Status"] . "&updStatus")); ?></td>
</tr><!--/shipping_list_item_ADMIN-->