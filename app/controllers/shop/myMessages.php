<?php  // Shop - My Messages

?>

<section id="cart_items"><!--my_messages-->
  <div class="container">
    <div class="row">
      <div class="col-sm-12 bg">
        <h2 class="title text-center">My Messages</h2>
      </div>
    </div>

    <div class="row"><?php
      // Check User is Logged In
      if (!isset($_SESSION["userLogin"])) : ?>
        <div class="register-req">
          <p>Please <a href="index.php?p=login">Login (or Signup)</a> to proceed.</p>
        </div><?php
      else :  // Display Message List ?>
        <!-- Messages Table List -->
        <div class="table-responsive" style="margin-bottom:75px">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <!-- Messages Table Header -->
                <th>ID</th>
                <th>Date/Time Sent</th>
                <th>Subject</th>
                <th>Date/Time Replied</th>
                <th>Message Status</th>
              </tr>
            </thead>
            <tbody><?php
              include_once "../app/models/messageClass.php";
              $message = new Message();
              $messageCount = 0;
              foreach (new RecursiveArrayIterator($message->getListByUser($_SESSION["userID"], 1)) as $record) {
                include "../app/views/shop/messageListItem.php";
                $messageCount += 1;
              }
              if ($messageCount == 0) echo "<tr><td colspan ='7'>No Messages to Display</td></tr>";
              ?>
            </tbody>
          </table>
        </div><?php
      endif; ?>
    </div>
  </div>
</section><!--/my_messages-->