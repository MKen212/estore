<tr>
  <td><?= $record["ProductID"]; ?></td>
  <td><a href="admin_dashboard.php?p=productDetails&id=<?= $record["ProductID"]; ?>"><?= $record["Name"]; ?></a></td>
  <td><?= $record["Category"]; ?></td>
  <td><?= $record["Brand"]; ?></td>
  <td><?= $record["Price"]; ?></td>
  <td><?= $record["WeightGrams"]; ?></td>
  <td><?= $record["QtyAvail"]; ?></td>
  <td><?= date("d/m/Y @ H:i", strtotime($record["EditTimestamp"])) . " by " . $record["EditUserID"]; ?></td>
  <td><?= statusOutput("Flag", $record["Flag"], ("admin_dashboard.php?p=products&id=" . $record["ProductID"] . "&cur=" . $record["Flag"] . "&updFlag")); ?></td>
  <td><?= statusOutput("Status", $record["Status"], ("admin_dashboard.php?p=products&id=" . $record["ProductID"] . "&cur=" . $record["Status"] . "&updStatus")); ?></td>
</tr>