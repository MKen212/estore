<!-- Login Form -->
<div class="row">
  <form class="form-user" action="" method="POST" name="loginForm">
    <h3 class="mb-3">Please sign in</h3>
    <!-- Username -->
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text form-labels">Username:</span>
      </div>
      <input class="form-control" type="text" name="estUsername" placeholder="Username" required autofocus />
    </div>
    <!-- Password -->
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text form-labels">Password:</span>
      </div>
      <input class="form-control" type="password" name="estPassword"  placeholder="Password" required />
    </div>
    <br />
    <!-- Submit Button -->
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="login" >Sign in</button>
    <!-- Shop & New Account Links -->
    <a class="mr-3" href="/">To eStore</a>
    <a class="ml-3" href="admin_login.php?p=register">Create new account</a>
  </form>
</div>
<!-- Result -->
<div class="row justify-content-center">
  <?php 
    include("../app/controllers/adminLogin.php");
  ?>
</div>
