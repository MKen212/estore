<tr><!--message_list_item_ADMIN-->
  <td><?= $record["MessageID"]; ?></td>
  <td><a href="admin_dashboard.php?p=messageDetails&id=<?= $record["MessageID"]; ?>"><?= $record["Subject"]; ?></a></td>
  <td><?= $record["SenderEmail"]; ?></td>
  <td><?= $record["SenderName"]; ?></td>
  <td><?= date("d/m/Y @ H:i", strtotime($record["AddedTimestamp"])) . " by " . $record["AddedUserID"]; ?></td>
  <td>
    <?php if ($record["ReplyTimestamp"] == "0000-00-00 00:00:00") {
      echo "- Pending -";
    } else {
      echo date("d/m/Y @ H:i", strtotime($record["ReplyTimestamp"])) . " by " . $record["ReplyUserID"];
    } ?>
  </td>
  <td><?= statusOutput("MessageStatus", $record["MessageStatus"]); ?></td>
  <td><?= statusOutput("Status", $record["Status"]); ?></td>
</tr><!--/message_list_item_ADMIN-->