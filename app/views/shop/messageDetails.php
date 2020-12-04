<div class="shopper-info"><!--message_details_SHOP-->
  <div class="row">
    <div class="col-sm-6"><!--message_information-->
      <h5>Message Information</h5>
      <table class="table table-sm">
        <tr>
          <td><b>Message ID:</b></td>
          <td><b><?= $messageData["MessageID"] ?></b></td>
        </tr>
        <tr>
          <td>Message Status:</td>
          <td><?= statusOutputShop("MessageStatus", $messageData["MessageStatus"]) ?></td>
        </tr>
        <tr>
          <td>Name:</td>
          <td><?= $messageData["SenderName"] ?></td>
        </tr>
        <tr>
          <td>Email:</td>
          <td><?= $messageData["SenderEmail"] ?></td>
        </tr>
        <tr>
          <td>Date/Time Submitted:</td>
          <td><?= date("d/m/Y @ H:i", strtotime($messageData["AddedTimestamp"])) ?></a></td>
        </tr>
      </table>
    </div><!--/message_information-->
    <div class="col-sm-6"><!--message-->
      <h5>Received Message</h5>
      <table class="table table-sm">
        <tr>
          <td><b>Subject: <?= $messageData["Subject"] ?></b></td>
        </tr>
        <tr>
          <td><textarea rows="7" readonly><?= fixCRLF($messageData["Body"]) ?></textarea></td>
        </tr>
      </table>
    </div><!--/message-->
  </div>
  
  <div class="row" style="margin-bottom:50px">
    <div class="col-sm-6"><!--reply_information-->
      <h5>Reply Information</h5>
      <table class="table table-sm">
        <tr>
          <td>Date/Time Replied:</td>
          <td><?= ($messageData["ReplyTimestamp"] == "0000-00-00 00:00:00") ? "- Pending -" : date("d/m/Y @ H:i", strtotime($messageData["ReplyTimestamp"])) ?></td>
        </tr>
        <tr>
          <td>Replied By:</td>
          <td><?= (!empty($messageData["ReplyUsername"])) ? $messageData["ReplyUsername"] : "" ?></td>
        </tr>

      </table>
    </div><!--/reply_information-->
    <div class="col-sm-6"><!--reply-->
      <h5>Reply</h5>
      <table class="table table-sm">
        <tr>
          <td><textarea rows="7" readonly><?= fixCRLF($messageData["Reply"]) ?></textarea></td>
        </tr>
      </table>
    </div><!--/reply-->

  </div>
</div><!--message_details_SHOP-->