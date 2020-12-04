<!-- Messages List - ADMIN -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Messages</h2>
</div>

<div class="row">
  <!-- Messsages Table Search -->
  <div class="col-4 mb-3">
    <form action="" method="post" name="schMessages">
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
  <div class="col-6"><?php
    msgShow(); ?>
  </div>
</div>

<div class="row">
  <!-- Messages Table List -->
  <div class="table-responsive">
    <table class="table table-striped table-sm tableScrollable">
      <thead>
        <tr>
          <th style="width: 14%"><br />Date/Time Added</th>
          <th style="width: 26%"><br />Subject</th>
          <th style="width: 18%"><br />Sender Email</th>
          <th style="width: 11%"><br />Sender Name</th>
          <th style="width: 18%"><br />Date/Time Replied</th>
          <th style="width: 7%">Message<br />Status</th>
          <th style="width: 6%">Record<br />Status</th>
        </tr>
      </thead>
      <tbody><?php
        foreach($messageList as $record) : ?>
          <tr><!-- Message Record-->
            <td style="width: 14%"><?= date("d/m/Y @ H:i", strtotime($record["AddedTimestamp"])) ?></td>
            <td style="width: 26%"><a href="admin_dashboard.php?p=messageDetails&id=<?= $record["MessageID"] ?>"><?= $record["Subject"] ?></a></td>
            <td style="width: 18%"><?= $record["SenderEmail"] ?></td>
            <td style="width: 11%"><?= $record["SenderName"] ?></td>
            <td style="width: 18%"><?php
              if ($record["ReplyTimestamp"] == "0000-00-00 00:00:00") {
                echo "- Pending -";
              } else {
                echo date("d/m/Y @ H:i", strtotime($record["ReplyTimestamp"])) . " by " . $record["ReplyUserID"];
              } ?>
            </td>
            <td style="width: 7%"><?= statusOutput("MessageStatus", $record["MessageStatus"]) ?></td>
            <td style="width: 6%"><?= statusOutput("Status", $record["Status"]) ?></td>
          </tr><?php
        endforeach; ?>
      </tbody>
    </table>
  </div>
</div>