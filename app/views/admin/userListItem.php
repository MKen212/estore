<tr>
  <td><a href="admin_dashboard.php?p=userDetails&id=<?= $record["UserID"]; ?>"><?= $record["UserID"]; ?></a></td>
  <td><?= $record["Email"]; ?></td>
  <td><?= $record["Name"]; ?></td>
  <td><?= statusOutput("IsAdmin", $record["IsAdmin"]); ?></td>
  <td><?= statusOutput("Status", $record["Status"]); ?></td>
</tr>
