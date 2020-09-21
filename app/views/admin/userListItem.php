<tr>
  <td><?= $record["UserID"]; ?></td>
  <td><a href="admin_dashboard.php?p=userDetails&id=<?= $record["UserID"] ?>"><?= $record["Email"]; ?></a></td>
  <td><?= $record["Name"]; ?></td>
  <td><?= date("d/m/Y @ H:i", strtotime($record["EditTimestamp"])) . " by " . $record["EditUserID"]; ?></td>
  <td><?= $record["LoginTimestamp"] == "0000-00-00 00:00:00" ? "-Never-" : date("d/m/Y @ H:i", strtotime($record["LoginTimestamp"])); ?></td>
  <td><?= statusOutput("IsAdmin", $record["IsAdmin"], ("admin_dashboard.php?p=users&id=" . $record["UserID"] . "&cur=" . $record["IsAdmin"] . "&updIsAdmin")); ?></td>
  <td><?= statusOutput("Status", $record["Status"], ("admin_dashboard.php?p=users&id=" . $record["UserID"] . "&cur=" . $record["Status"] . "&updStatus")); ?></td>
</tr>
