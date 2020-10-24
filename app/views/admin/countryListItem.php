<tr><!--country_list_item_ADMIN-->
  <td style="width:10%"><?= $record["Code"]; ?></td>
  <td style="width:30%"><a href="admin_dashboard.php?p=countryDetails&code=<?= $record["Code"]; ?>"><?= $record["Name"]; ?></a></td>
  <td style="width:20%"><?= $record["ShippingBand"]; ?></td>
  <td style="width:25%"><?= date("d/m/Y @ H:i", strtotime($record["EditTimestamp"])) . " by " . $record["EditUserID"]; ?></td>
  <td style="width:15%"><?= statusOutput("Status", $record["Status"], ("admin_dashboard.php?p=countries&code=" . $record["Code"] . "&cur=" . $record["Status"] . "&updStatus")); ?></td>
</tr><!--/country_list_item_ADMIN-->