<!-- Register Form - ADMIN -->
<div class="row justify-content-center">
  <form class="form-user" action="" method="POST" name="registerForm" autocomplete="off">
    <h3 class="mb-3">User Registration Form</h3>
    <!-- Email -->
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text form-labels">Email:</span>
      </div>
      <input class="form-control" type="email" name="email" placeholder="Enter Email Address" required autofocus />
    </div>
    <!-- Password -->
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text form-labels">Password:</span>
      </div>
      <input class="form-control" type="password" name="password" minlength="5" placeholder="Enter Password" required />
    </div>
    <!-- Name -->
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text form-labels">Name:</span>
      </div>
      <input class="form-control" type="text" name="name" placeholder="Enter Name" required />
    </div>
    <br />
    <!-- Submit Button -->
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="register">Register</button>
    <!-- Shop & Login Links -->
    <a class="mr-3" href="/">To E-STORE</a>
    <a class="ml-3" href="admin_login.php?p=login">Back to Admin Login</a>
    <br />
  </form>
</div>
<!-- Result -->
<div class="row justify-content-center" id="registerFormResult"><?php
  msgShow(); ?>
</div>
