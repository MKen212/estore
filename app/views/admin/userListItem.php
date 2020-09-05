<tr>
  <td><a href="admin_dashboard.php?p=userDetails&id=<?= $record["UserID"]; ?>"><?= $record["UserID"]; ?></a></td>
  <td><?= $record["Email"]; ?></td>
  <td><?= $record["Name"]; ?></td>
  <td><?= date("d/m/Y @ H:i", strtotime($record["EditTimestamp"])) . " by " . $record["EditUserID"]; ?></td>
  <td><?= $record["LoginTimestamp"] == "0000-00-00 00:00:00" ? "-Never-" : date("d/m/Y @ H:i", strtotime($record["LoginTimestamp"])); ?></td>
  <td><?= statusOutput("IsAdmin", $record["IsAdmin"]); ?></td>
  <td><?= statusOutput("Status", $record["Status"]); ?></td>
</tr>
