<tr><!--message_list_item_SHOP-->
  <td><?= $record["MessageID"]; ?></td>
  <td><?= date("d/m/Y @ H:i", strtotime($record["AddedTimestamp"])); ?></td>
  <td><a href="index.php?p=messageDetails&id=<?= $record["MessageID"]; ?>"><?= $record["Subject"]; ?></a></td>
  <td><?php
    if ($record["ReplyTimestamp"] == "0000-00-00 00:00:00") {
      echo "- Pending -";
    } else {
      echo date("d/m/Y @ H:i", strtotime($record["ReplyTimestamp"]));
    } ?>
  </td>
  <td><?= statusOutputShop("MessageStatus", $record["MessageStatus"]); ?></td>
</tr><!--/message_list_item_SHOP-->