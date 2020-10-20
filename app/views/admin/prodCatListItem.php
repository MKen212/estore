<tr><!--product_category_list_item_ADMIN-->
  <td><?= $record["ProdCatID"]; ?></td>
  <td><a href="admin_dashboard.php?p=prodCatDetails&id=<?= $record["ProdCatID"]; ?>"><?= $record["Name"]; ?></a></td>
  <td><?= date("d/m/Y @ H:i", strtotime($record["EditTimestamp"])) . " by " . $record["EditUserID"]; ?></td>
  <td><?= statusOutput("Status", $record["Status"], ("admin_dashboard.php?p=prodCats&id=" . $record["ProdCatID"] . "&cur=" . $record["Status"] . "&updStatus")); ?></td>
</tr><!--/product_category_list_item_ADMIN-->