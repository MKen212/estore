<tr><!--returns_list_item_ADMIN-->
  <td><a href="admin_dashboard.php?p=returnDetails&id=<?= $record["ReturnID"]; ?>"><?= $record["ReturnsRef"]; ?></a></td>
  <td><?= $record["InvoiceID"]; ?></td>
  <td><?= $record["ItemCount"]; ?></td>
  <td><?= $record["ProductCount"]; ?></td>
  <td><?= $record["Total"]; ?></td>
  <td><?= date("d/m/Y @ H:i", strtotime($record["AddedTimestamp"])) . " by " . $record["OwnerUserID"]; ?></td>
  <td><?= statusOutput("ReturnStatus", $record["ReturnStatus"]); ?></td>
  <td><?= statusOutput("Status", $record["Status"]); ?></td>
</tr><!--/returns_list_item_ADMIN-->