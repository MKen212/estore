<!-- Message Details Form - ADMIN -->
<div class="row pt-3 pb-2 mb-3 border-bottom">
  <div class="col-6">
    <h2>Message Details - ID: <?= $messageID ?></h2>
  </div>
  <!-- System Messages -->
  <div class="col-6"><?php
    msgShow(); ?>
  </div>
</div><?php

if ($messageRecord == false) :  // Message Record not found ?>
  <div>Message ID not found.</div><?php
else :  // Display Message Form ?>
  <div class="row">
    <!-- Message Information -->
    <div class="col-6">
      <h5>Message Information</h5>
      <table class="table table-sm">
        <tr>
          <td>Message Status:</td>
          <td><?= statusOutput("MessageStatus", $messageRecord["MessageStatus"], ("admin_dashboard.php?p=messageDetails&id=" . $messageRecord["MessageID"] . "&cur=" . $messageRecord["MessageStatus"] . "&updMessageStatus")) ?></td>
        </tr>
        <tr>
          <td>Record Status:</td>
          <td><?= statusOutput("Status", $messageRecord["Status"], ("admin_dashboard.php?p=messageDetails&id=" . $messageRecord["MessageID"] . "&cur=" . $messageRecord["Status"] . "&updStatus")) ?></td>
        </tr>
        <tr>
          <td>Sender Name:</td>
          <td><?= $messageRecord["SenderName"] ?></td>
        </tr>
        <tr>
          <td>Sender Email:</td>
          <td><?= $messageRecord["SenderEmail"] ?></td>
        </tr>
        <tr>
          <td>Date/Time Received:</td>
          <td><?= date("d/m/Y @ H:i", strtotime($messageRecord["AddedTimestamp"])) . " by " ?><a class="badge badge-info" href="admin_dashboard.php?p=userDetails&id=<?= $messageRecord["AddedUserID"] ?>"><?= $messageRecord["AddedUserID"] ?></a></td>
        </tr>
        <tr>
          <td>Last Edit:</td>
          <td><?= date("d/m/Y @ H:i", strtotime($messageRecord["EditTimestamp"])) . " by " ?><a class="badge badge-info" href="admin_dashboard.php?p=userDetails&id=<?= $messageRecord["EditUserID"] ?>"><?= $messageRecord["EditUserID"] ?></a></td>
        </tr>
      </table>
    </div>

    <!-- Message -->
    <div class="col-sm-6">
      <h5>Received Message</h5>
      <table class="table table-sm">
        <tr>
          <td><b>Subject: <?= $messageRecord["Subject"]; ?></b></td>
        </tr>
        <tr>
          <td>
            <textarea class="taFixed" rows="7" readonly><?= fixCRLF($messageRecord["Body"]); ?></textarea>
          </td>
        </tr>
      </table>     
    </div>
  </div>

  <div class="row">
    <!-- Reply Information -->
    <div class="col-6">
      <h5>Reply Information</h5>
      <table class="table table-sm">
        <tr>
          <td>Date/Time Replied:</td>
          <td><?php
            if ($messageRecord["ReplyTimestamp"] == "0000-00-00 00:00:00") { 
              echo "- Pending -";
            } else {
              echo date("d/m/Y @ H:i", strtotime($messageRecord["ReplyTimestamp"])) . " by <a class='badge badge-info' href='admin_dashboard.php?p=userDetails&id=" . $messageRecord["ReplyUserID"] . "'>" . $messageRecord["ReplyUserID"] . "</a>";
            } ?>
          </td>
        </tr>
        <tr>
          <td>Replied Username:</td>
          <td><?= !empty($messageRecord["ReplyUsername"]) ? $messageRecord["ReplyUsername"] : ""; ?></td>
        </tr>
      </table>
    </div>

    <!-- Reply -->
    <div class="col-sm-6">
      <h5>Reply</h5>
      <form action="" method="POST" name="messageForm" autocomplete="off">
        <table class="table table-sm">
          <tr>
            <td>
              <textarea class="taFixed" name="reply" rows="7" maxlength="500" required><?= fixCRLF($messageRecord["Reply"]); ?></textarea>
            </td>
          </tr>
          <tr>
            <td style="border-top:none">
              <button class="btn btn-primary" type="submit" name="updateReply">Update Reply</button>
            </td>
          </tr>
        </table>
      </form>    
    </div>
  </div><?php
endif; ?>