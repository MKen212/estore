<!-- Users List - ADMIN -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Users</h2>
</div>

<div class="row">
  <!-- Users Table Search -->
  <div class="col-4 mb-3">
    <form action="" method="post" name="schUsers">
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
  <div class="col-6"><?php
    msgShow(); ?>
  </div>
</div>

<div class="row">
  <!-- Users Table List -->
  <div class="table-responsive">
    <table class="table table-striped table-sm tableScrollable">
      <thead>
        <tr>
          <th style="width: 25%">Email</th>
          <th style="width: 16%">Name</th>
          <th style="width: 21%">Last Edit</th>
          <th style="width: 21%">Last Login</th>
          <th style="width: 8%">Admin</th>
          <th style="width: 9%">Status</th>
        </tr>
      </thead>
      <tbody><?php
        if (empty($userList)) :  // No User Records Found ?>
          <tr>
            <td colspan="6">No Users to Display</td>
          </tr><?php
        else :
          foreach ($userList as $record) : ?>
            <tr><!-- User Record -->
              <td style="width: 25%"><a href="admin_dashboard.php?p=userDetails&id=<?= $record["UserID"] ?>"><?= $record["Email"] ?></a></td>
              <td style="width: 16%"><?= $record["Name"] ?></td>
              <td style="width: 21%"><?= date("d/m/Y @ H:i", strtotime($record["EditTimestamp"])) . " by " . $record["EditUserID"] ?></td>
              <td style="width: 21%"><?php 
                if ($record["LoginTimestamp"] == "0000-00-00 00:00:00") {
                  echo "- Never -";
                } else {
                  echo date("d/m/Y @ H:i", strtotime($record["LoginTimestamp"])); 
                } ?>
              </td>  
              <td style="width: 8%"><?= statusOutput("IsAdmin", $record["IsAdmin"], ("admin_dashboard.php?p=users&id=" . $record["UserID"] . "&cur=" . $record["IsAdmin"] . "&updIsAdmin")) ?></td>
              <td style="width: 9%"><?= statusOutput("Status", $record["Status"], ("admin_dashboard.php?p=users&id=" . $record["UserID"] . "&cur=" . $record["Status"] . "&updStatus")) ?></td>
            </tr><?php
          endforeach;
        endif; ?>
      </tbody>
    </table>
  </div>
</div>