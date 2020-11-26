<!-- Messages List - ADMIN -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Messages</h2>
</div>

<div class="row">
  <!-- Messsages Table Search -->
  <div class="col-4 mb-3">
    <form action="" method="POST" name="schMessages">
      <div class="input-group">
        <input class="form-control" type="text" name="schEmailorSubj" placeholder="Search Email or Subject" autocomplete="off" />
        <div class="input-group-append">
          <button class="btn btn-secondary" type="submit" name="messageSearch"><span data-feather="search"></span></button>
        </div>
      </div>
    </form>
  </div>
  <!-- New Message Button -->
  <div class="col-2">
    <!-- ** NOT REQUIRED - Messages should only be added in Shop ** -->
  </div>
  <!-- System Messages -->
  <div class="col-6">
    <?php msgShow(); ?>
  </div>
</div>

<div class="row">
  <!-- Messages Table List -->
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <th>ID</th>
        <th>Subject</th>
        <th>Sender Email</th>
        <th>Sender Name</th>
        <th>Date/Time Added</th>
        <th>Date/Time Replied</th>
        <th>Message<br />Status</th>
        <th>Record<br />Status</th>
      </thead>
      <tbody>
        <?php foreach($messageList as $record) : ?>
          <tr><!-- Message Record-->
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
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>