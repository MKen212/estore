<tr><!--product_brand_list_item_ADMIN-->
  <td><?= $record["ProdBrandID"]; ?></td>
  <td><a href="admin_dashboard.php?p=prodBrandDetails&id=<?= $record["ProdBrandID"]; ?>"><?= $record["Name"]; ?></a></td>
  <td><?= date("d/m/Y @ H:i", strtotime($record["EditTimestamp"])) . " by " . $record["EditUserID"]; ?></td>
  <td><?= statusOutput("Status", $record["Status"], ("admin_dashboard.php?p=prodBrands&id=" . $record["ProdBrandID"] . "&cur=" . $record["Status"] . "&updStatus")); ?></td>
</tr><!--/product_brand_list_item_ADMIN-->