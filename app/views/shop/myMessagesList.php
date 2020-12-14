<!-- My Messages List - SHOP -->
<section id="cart_items">
  <div class="container">
    <!-- Title Block -->
    <div class="row">
      <div class="col-sm-12 bg">
        <h2 class="title text-center">My Messages</h2>
      </div>
    </div>
    <!-- System Messages -->
    <div class="row"><?php
      msgShow(); ?>
    </div>

    <!-- Messages List -->
    <div class="row"><?php
      if (!isset($_SESSION["userLogin"])) :  // Check User is Logged In?>
        <div class="register-req">
          <p>Please <a href="index.php?p=login">Login (or Signup)</a> to proceed.</p>
        </div><?php
      else :  // Display Message List ?>
        <div class="table-responsive" style="margin-bottom:75px">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>Date/Time Sent</th>
                <th>Subject</th>
                <th>Date/Time Replied</th>
                <th>Message Status</th>
              </tr>
            </thead>
            <tbody><?php
              if (empty($messageList)) :  // No Message Records Found ?>
              <tr>
                  <td colspan="4">No Messages to Display</td>
                </tr><?php
              else :
                foreach ($messageList as $record) : ?>
                  <tr><!-- Message Record -->
                    <td><?= date("d/m/Y @ H:i", strtotime($record["AddedTimestamp"])) ?></td>
                    <td><a href="index.php?p=messageDetails&id=<?= $record["MessageID"] ?>"><?= $record["Subject"] ?></a></td>
                    <td><?php
                      if ($record["ReplyTimestamp"] == "0000-00-00 00:00:00") {
                        echo "- Pending -";
                      } else {
                        echo date("d/m/Y @ H:i", strtotime($record["ReplyTimestamp"]));
                      } ?>
                    </td>
                    <td><?= statusOutputShop("MessageStatus", $record["MessageStatus"]) ?></td>
                  </tr><?php
                endforeach;
              endif; ?>
            </tbody>
          </table>
        </div><?php
      endif; ?>
    </div>
  </div>
</section>