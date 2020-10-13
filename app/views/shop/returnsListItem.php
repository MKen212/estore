<tr><!--returns_list_item_SHOP-->
  <td><a href="index.php?p=returnDetails&id=<?= $record["ReturnID"]; ?>"><?= $record["ReturnsRef"]; ?></a></td>
  <td><?= $record["InvoiceID"]; ?></td>
  <td><?= $record["ItemCount"]; ?></td>
  <td><?= $record["ProductCount"]; ?></td>
  <td><?= date("d/m/Y @ H:i", strtotime($record["AddedTimestamp"])); ?></td>
  <td><?= symValue($record["RefundTotal"]); ?></td>
  <td><?= statusOutputShop("ReturnStatus", $record["ReturnStatus"]); ?></td>
</tr><!--/returns_list_item_SHOP-->