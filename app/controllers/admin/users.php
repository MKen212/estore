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
      <button class="btn btn-primary" type="button" name="userAdd">Add New User</button>
    </div>
  </div>
  <div class="col-6">
  </div>

<!-- Users Table List -->
<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <!-- Users Table Header -->
      <th>User ID</th>
      <th>Email</th>
      <th>Name</th>
      <th>Admin User</th>
      <th>Status</th>
    </thead>
    <tbody>
      <?php
      include_once "../app/models/userClass.php";
      $user = new User();

      if (isset($_POST["userSearch"])) {
        $email = fixSearch($_POST["schEmail"]);
        $_POST = [];
        foreach(new RecursiveArrayIterator($user->getListByEmail($email)) as $record) {
          include "../app/views/admin/userListItem.php";
        }
      } else {
        foreach(new RecursiveArrayIterator($user->getList()) as $record) {
          include "../app/views/admin/userListItem.php";
        }
      }
      ?>      
    </tbody>
  </table>
</div>
