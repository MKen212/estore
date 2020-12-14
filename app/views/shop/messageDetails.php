<!-- Message Details - SHOP -->
<section id="cart_items">
  <div class="container">
    <!-- Title Block -->
    <div class="row">
      <div class="col-sm-12 bg">
        <h2 class="title text-center">Message Details</h2>
      </div>
    </div>
    <!-- System Messages -->
    <div class="row"><?php
      msgShow(); ?>
    </div>

    <!-- Message Details -->
    <div class="row"><?php
      if (empty($refData)) :  // Message Record not found ?>
        <div class="register-req">
          <p>Message ID '<?= $messageID ?>' not found.</p>
        </div><?php
      elseif ($isSender != true) :  // Message was not sent by current user ?>
        <div class="register-req">
          <p>Sorry - You do not have access to Message ID '<?= $messageID ?>'.</p>
        </div><?php
      elseif ($isActive != true) :  // Message is not active ?>
        <div class="register-req">
          <p>Sorry - Message ID '<?= $messageID ?>' is marked as 'Inactive'.</p>
        </div><?php
      else :  // Display Message Details ?>
        <div class="shopper-info">
          <div class="row">
            <!-- Message Information -->
            <div class="col-sm-6">
              <h5>Message Information</h5>
              <table class="table table-sm">
                <tr>
                  <td><b>Message ID:</b></td>
                  <td><b><?= $messageRecord["MessageID"] ?></b></td>
                </tr>
                <tr>
                  <td>Message Status:</td>
                  <td><?= statusOutputShop("MessageStatus", $messageRecord["MessageStatus"]) ?></td>
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
                  <td>Date/Time Submitted:</td>
                  <td><?= date("d/m/Y @ H:i", strtotime($messageRecord["AddedTimestamp"])) ?></a></td>
                </tr>
              </table>
            </div>
            <!-- Message -->
            <div class="col-sm-6">
              <h5>Received Message</h5>
              <table class="table table-sm">
                <tr>
                  <td><b>Subject: <?= $messageRecord["Subject"] ?></b></td>
                </tr>
                <tr>
                  <td><textarea rows="7" readonly><?= fixCRLF($messageRecord["Body"]) ?></textarea></td>
                </tr>
              </table>
            </div>
          </div>
          
          <div class="row" style="margin-bottom:50px">
            <!-- Reply Information -->
            <div class="col-sm-6">
              <h5>Reply Information</h5>
              <table class="table table-sm">
                <tr>
                  <td>Date/Time Replied:</td>
                  <td><?= ($messageRecord["ReplyTimestamp"] == "0000-00-00 00:00:00") ? "- Pending -" : date("d/m/Y @ H:i", strtotime($messageRecord["ReplyTimestamp"])) ?></td>
                </tr>
                <tr>
                  <td>Replied By:</td>
                  <td><?= (!empty($messageRecord["ReplyUsername"])) ? $messageRecord["ReplyUsername"] : "" ?></td>
                </tr>

              </table>
            </div>
            <!-- Reply -->
            <div class="col-sm-6">
              <h5>Reply</h5>
              <table class="table table-sm">
                <tr>
                  <td><textarea rows="7" readonly><?= fixCRLF($messageRecord["Reply"]) ?></textarea></td>
                </tr>
              </table>
            </div>
          </div>
        </div><?php
      endif; ?>
    </div>
  </div>
</section>