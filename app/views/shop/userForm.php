<div class="col-sm-4 col-sm-offset-1" style="margin-bottom:50px">
  <div class="signup-form">
    <form action="" method="POST" name="userForm" autocomplete="off">
      <!-- Email -->
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" placeholder="Update Email Address" value="<?= $userData["Email"]; ?>" required />
      <!-- Password -->
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" minlength="5" placeholder="Update Password" />
      <!-- Name -->
      <label for="name">Name:</label>
      <input type="text" name="name" id="name" placeholder="Update Name" value="<?= $userData["Name"]; ?>" required />
      <!-- Submit Button -->
      <button class="btn btn-default update" type="submit" name="updateUser">Update</button>
    </form>
  </div><!--/Shop User form-->
  <div>
    <?php msgShow();  // Show Result ?>
  </div>
</div>
<div class="col-sm-2"></div>
<div class="col-sm-5">
  <ul>
    <li><b>Account Links:</b></li>
    <li><a class="btn btn-default update" href="index.php?p=myOrders"><i class="fa fa-gift"></i> My Orders</a></li>
    <li><a class="btn btn-default update" href="index.php?p=myReturns"><i class="fa fa-arrow-circle-left"></i> My Returns</a></li>
    <li><a class="btn btn-default update" href="index.php?p=myMessages"><i class="fa fa-envelope"></i> My Messages</a></li>
  </ul>
</div>