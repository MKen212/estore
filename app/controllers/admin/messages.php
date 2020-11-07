<?php  // Admin Dashboard - Messages List/Edit

?>

<!-- Main Section - Messages List -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Messages</h2>
</div>

<div class="row">
  <!-- Messsages Table Search -->
  <div class="col-4 mb-3">
    <form action="" method="POST" name="schMessages">
      <!-- Search -->
      <div class="input-group">
        <input class="form-control" type="text" name="schEmailorSubj" placeholder="Search Email or Subject" autocomplete="off" />
        <div class="input-group-append">
          <button class="btn btn-secondary" type="submit" name="messageSearch"><span data-feather="search"></span></button>
        </div>
      </div>
    </form>
  </div>
  <div class="col-2">
    <!-- New Message Button ** NOT REQUIRED - Messages only added in Shop** -->
  </div>
  <div class="col-6">
    <!-- System Messages -->
    <?php msgShow(); ?>
  </div>
</div>

<!-- Messages Table List -->
<div class="row">
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <!-- Messages Table Header -->
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
        <?php
        if (isset($_POST["messageSearch"])) {
          $search = fixSearch($_POST["schEmailorSubj"]);
          $_POST=[];
        } else {
          $search = null;
        }
        include_once "../app/models/messageClass.php";
        $message = new Message();
        foreach(new RecursiveArrayIterator($message->getList($search)) as $record) {
          include "../app/views/admin/messageListItem.php";
        }
        ?>      
      </tbody>
    </table>
  </div>
</div>