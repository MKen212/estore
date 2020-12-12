<!-- User Details Form - SHOP -->
<section id="cart_items">
  <div class="container">
    <!-- Title Block -->
    <div class="row">
      <div class="col-sm-12 bg">
        <h2 class="title text-center">My Account</h2>
      </div>
    </div>

    <!-- System Messages -->
    <div class="row"><?php
      msgShow();  // Show any system messages ?>
    </div><?php
      // Check User is Logged In
      if (!isset($_SESSION["userLogin"])) : ?>
        <div class="row register-req">
          <p>Please <a href="index.php?p=login">Login (or Signup)</a> to proceed.</p>
        </div><?php
      else : ?>
        <!-- My Account -->
        <div class="row">
          <!-- User Form -->
          <div class="col-sm-4 col-sm-offset-1" style="margin-bottom:50px">
            <div class="signup-form">
              <form action="" method="post" name="userForm" autocomplete="off">
                <!-- Email -->
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" maxlength="50" placeholder="Update Email Address" value="<?= $userRecord["Email"] ?>" required />
                <!-- Password -->
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" minlength="5" placeholder="Update Password" />
                <!-- Name -->
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" maxlength="50" placeholder="Update Name" value="<?= $userRecord["Name"] ?>" required />
                <!-- Submit Button -->
                <button class="btn btn-default update" type="submit" name="updateUser">Update</button>
              </form>
            </div>
          </div>
          <div class="col-sm-2"></div>
          <!-- Account Links -->
          <div class="col-sm-5">
            <ul>
              <li><b>Account Links:</b></li>
              <li><a class="btn btn-default update" href="index.php?p=myOrders"><i class="fa fa-gift"></i> My Orders</a></li>
              <li><a class="btn btn-default update" href="index.php?p=myReturns"><i class="fa fa-arrow-circle-left"></i> My Returns</a></li>
              <li><a class="btn btn-default update" href="index.php?p=myMessages"><i class="fa fa-envelope"></i> My Messages</a></li>
            </ul>
          </div>        
        </div><?php  
      endif; ?>
    </div>
  </div>
</section>