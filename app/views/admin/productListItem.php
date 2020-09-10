<tr>
  <td><a href="admin_dashboard.php?p=productDetails&id=<?= $record["ProductID"]; ?>"><?= $record["ProductID"]; ?></a></td>
  <td><?= $record["Name"]; ?></td>
  <td><?= $record["Category"]; ?></td>
  <td><?= $record["Price"]; ?></td>
  <td><?= $record["WeightGrams"]; ?></td>
  <td><?= $record["QtyAvail"]; ?></td>
  <td><?= date("d/m/Y @ H:i", strtotime($record["EditTimestamp"])) . " by " . $record["EditUserID"]; ?></td>
  <td><?= statusOutput("IsNew", $record["IsNew"]); ?></td>
  <td><?= statusOutput("IsOnSale", $record["IsOnSale"]); ?></td>
  <td><?= statusOutput("Status", $record["Status"]); ?></td>
</tr>