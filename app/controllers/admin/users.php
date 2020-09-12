<!-- Admin Dashboard - Users List/Edit -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Users</h2>
</div>

<div class="row">
  <!-- Users Table Search -->
  <div class="col-4 mb-3">
    <form action="" method="POST" name="schUsers">
      <!-- Search -->
      <div class="input-group">
        <input class="form-control" type="text" name="schEmail" placeholder="Search Email" autocomplete="off" />
        <div class="input-group-append">
          <button class="btn btn-secondary" type="submit" name="userSearch"><span data-feather="search"></span></button>
        </div>
      </div>
    </form>
  </div>
  <div class="col-2">
    <!-- New User Button -->
    <div class="input-group">
      <a class="btn btn-primary" href="admin_dashboard.php?p=userAdd">Add New User</a>
    </div>
  </div>
  <div class="col-6">
  </div>
</div>

<div class="row">
  <!-- Users Table List -->
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <!-- Users Table Header -->
        <th>ID</th>
        <th>Email</th>
        <th>Name</th>
        <th>Last Edit</th>
        <th>Last Login</th>
        <th>Admin User</th>
        <th>Status</th>
      </thead>
      <tbody>
        <?php
        if (isset($_POST["userSearch"])) {
          $email = fixSearch($_POST["schEmail"]);
          $_POST = [];
        } else {
          $email = null;
        }
        include_once "../app/models/userClass.php";
        $user = new User();
        foreach(new RecursiveArrayIterator($user->getList($email)) as $record) {
          include "../app/views/admin/userListItem.php";
        }
        ?>      
      </tbody>
    </table>
  </div>
</div>
