<?php  // Shop - Message Details

?>
<section id="cart_items"><!--message_details-->
  <div class="container">
    <div class="row">
      <div class="col-sm-12 bg">
        <h2 class="title text-center">Message Details</h2>
      </div>
    </div><?php

      msgShow();  // Show any system messages coming from contact submission

      if (!isset($_GET["id"])) :  // Check MessageID Provided ?>
        <div class="register-req">
          <p>No Message ID provided.</p>
        </div><?php
      else :
        $messageID = $_GET["id"];
        $_GET = [];
        include_once "../app/models/messageClass.php";
        $message = new Message();

        $refData = $message->getRefData($messageID);
        if ($_SESSION["userID"] != $refData["AddedUserID"]) :  // Check Message was added by current user ?>
          <div class="register-req">
            <p>Sorry - You do not have access to Message ID `<?= $messageID ?>`.</p>
          </div><?php
        elseif ($refData["Status"] == 0) :  // Check Message is not Inactive ?>
          <div class="register-req">
            <p>Sorry - Message ID `<?= $messageID ?>` is marked as 'Inactive'.</p>
          </div><?php
        else :
          // Get Message Details & Show
          $messageData = $message->getRecord($messageID);

          include "../app/views/shop/messageDetails.php";

        endif;
      endif; ?>
  </div>
</section>