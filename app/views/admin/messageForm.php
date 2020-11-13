<!-- Message Form -->
<div class="row">
  <div class="col-6"><!--message_information-->
    <h5>Message Information</h5>
    <table class="table table-sm">
      <tr>
        <td>Message Status:</td>
        <td><?= statusOutput("MessageStatus", $messageData["MessageStatus"], ("admin_dashboard.php?p=messageDetails&id=" . $messageData["MessageID"] . "&cur=" . $messageData["MessageStatus"] . "&updMessageStatus")) ?></td>
      </tr>
      <tr>
        <td>Record Status:</td>
        <td><?= statusOutput("Status", $messageData["Status"], ("admin_dashboard.php?p=messageDetails&id=" . $messageData["MessageID"] . "&cur=" . $messageData["Status"] . "&updStatus")) ?></td>
      </tr>
      <tr>
        <td>Sender Name:</td>
        <td><?= $messageData["SenderName"] ?></td>
      </tr>
      <tr>
        <td>Sender Email:</td>
        <td><?= $messageData["SenderEmail"] ?></td>
      </tr>
      <tr>
        <td>Date/Time Received:</td>
        <td><?= date("d/m/Y @ H:i", strtotime($messageData["AddedTimestamp"])) . " by " ?><a class="badge badge-info" href="admin_dashboard.php?p=userDetails&id=<?= $messageData["AddedUserID"] ?>"><?= $messageData["AddedUserID"] ?></a></td>
      </tr>
      <tr>
        <td>Last Edit:</td>
        <td><?= date("d/m/Y @ H:i", strtotime($messageData["EditTimestamp"])) . " by " ?><a class="badge badge-info" href="admin_dashboard.php?p=userDetails&id=<?= $messageData["EditUserID"] ?>"><?= $messageData["EditUserID"] ?></a></td>
      </tr>
    </table>
  </div><!--/message_information-->

  <div class="col-sm-6"><!--message-->
    <h5>Received Message</h5>
    <table class="table table-sm">
      <tr>
        <td><b>Subject: <?= $messageData["Subject"]; ?></b></td>
      </tr>
      <tr>
        <td><textarea class="taFixed" rows="7" readonly><?= fixCRLF($messageData["Body"]); ?></textarea></td>
      </tr>
    </table>     
  </div><!--/message-->
</div>

<div class="row">
  <div class="col-6"><!--reply_information-->
    <h5>Reply Information</h5>
    <table class="table table-sm">
      <tr>
        <td>Date/Time Replied:</td>
        <td>
          <?php if ($messageData["ReplyTimestamp"] == "0000-00-00 00:00:00") { 
            echo "- Pending -";
          } else {
            echo date("d/m/Y @ H:i", strtotime($messageData["ReplyTimestamp"])) . " by <a class='badge badge-info' href='admin_dashboard.php?p=userDetails&id=" . $messageData["ReplyUserID"] . "'>" . $messageData["ReplyUserID"] . "</a>";
          } ?>
        </td>
      </tr>
    </table>
  </div><!--/reply_information-->

  <div class="col-sm-6"><!--reply-->
    <h5>Reply</h5>
    <form action="" method="POST" name="messageForm" autocomplete="off">
      <table class="table table-sm">
        <tr>
          <td><textarea class="taFixed" name="reply" rows="7" maxlength="500" required><?= fixCRLF($messageData["Reply"]); ?></textarea></td>
        </tr>
        <tr>
          <td style="border-top:none"><button class="btn btn-primary" type="submit" name="updateReply">Update Reply</button></td>
        </tr>
      </table>
    </form>    
  </div><!--/reply-->
</div>