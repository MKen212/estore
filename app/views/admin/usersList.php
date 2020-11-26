<!-- Users List - ADMIN -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Users</h2>
</div>

<div class="row">
  <!-- Users Table Search -->
  <div class="col-4 mb-3">
    <form action="" method="POST" name="schUsers">
      <div class="input-group">
        <input class="form-control" type="text" name="schEmail" placeholder="Search Email" autocomplete="off" />
        <div class="input-group-append">
          <button class="btn btn-secondary" type="submit" name="userSearch"><span data-feather="search"></span></button>
        </div>
      </div>
    </form>
  </div>
  <!-- New User Button -->
  <div class="col-2">
    <div class="input-group">
      <a class="btn btn-primary" href="admin_dashboard.php?p=userAdd">Add New User</a>
    </div>
  </div>
  <!-- System Messages -->
  <div class="col-6">
    <?php msgShow(); ?>
  </div>
</div>

<div class="row">
  <!-- Users Table List -->
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <th>ID</th>
        <th>Email</th>
        <th>Name</th>
        <th>Last Edit</th>
        <th>Last Login</th>
        <th>Admin</th>
        <th>Status</th>
      </thead>
      <tbody>
        <?php foreach($userList as $record) : ?>
          <tr><!-- User Record -->
            <td><?= $record["UserID"]; ?></td>
            <td><a href="admin_dashboard.php?p=userDetails&id=<?= $record["UserID"] ?>"><?= $record["Email"]; ?></a></td>
            <td><?= $record["Name"]; ?></td>
            <td><?= date("d/m/Y @ H:i", strtotime($record["EditTimestamp"])) . " by " . $record["EditUserID"]; ?></td>
            <td>
              <?php if ($record["LoginTimestamp"] == "0000-00-00 00:00:00") {
                echo "- Never -";
               } else {
                echo date("d/m/Y @ H:i", strtotime($record["LoginTimestamp"])); 

               } ?>
            </td>  
            <td><?= statusOutput("IsAdmin", $record["IsAdmin"], ("admin_dashboard.php?p=users&id=" . $record["UserID"] . "&cur=" . $record["IsAdmin"] . "&updIsAdmin")); ?></td>
            <td><?= statusOutput("Status", $record["Status"], ("admin_dashboard.php?p=users&id=" . $record["UserID"] . "&cur=" . $record["Status"] . "&updStatus")); ?></td>
          </tr>
        <?php endforeach; ?>      
      </tbody>
    </table>
  </div>
</div>