<!-- Login Form - ADMIN -->
<div class="row">
  <form class="form-user" action="" method="POST" name="loginForm">
    <h3 class="mb-3">Please sign in</h3>
    <!-- Email -->
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text form-labels">Email:</span>
      </div>
      <input class="form-control" type="email" name="estEmail" placeholder="Enter Email Address" required autofocus />
    </div>
    <!-- Password -->
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text form-labels">Password:</span>
      </div>
      <input class="form-control" type="password" name="estPassword"  placeholder="Enter Password" required />
    </div>
    <br />
    <!-- Submit Button -->
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="login" >Sign in</button>
    <!-- Shop & New Account Links -->
    <a class="mr-3" href="/">To E-STORE</a>
    <a class="ml-3" href="admin_login.php?p=register">Create new account</a>
  </form>
</div>