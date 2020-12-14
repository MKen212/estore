<!-- Login / Register Forms - SHOP -->
<section id="form">
  <div class="container">
    <!-- Title Block -->
    <div class="row">
      <div class="col-sm-12 bg">
        <h2 class="title text-center">Login / Sign-up</h2>
      </div>
    </div>
    <!-- System Messages -->
    <div class="row"><?php
      msgShow(); ?>
    </div>

    <div class="row">
      <!-- Login Form - SHOP -->
      <div class="col-sm-4 col-sm-offset-1">
        <div class="login-form">
          <h5>Login to your account</h5>
          <form action="" method="post" name="loginForm">
            <input type="email" name="estEmail" maxlength="50" placeholder="Enter Email Address" required />
            <input type="password" name="estPassword" placeholder="Enter Password" required />
            <button class="btn btn-default" type="submit" name="login">Login</button>
          </form>
        </div>
      </div>

      <!-- OR -->
      <div class="col-sm-1">
        <h2 class="or">OR</h2>
      </div>

      <!-- Register Form - SHOP -->
      <div class="col-sm-4">
        <div class="signup-form">
          <h5>New User Sign-up</h5>
          <form action="" method="post" name="registerForm" autocomplete="off">
            <input type="email" name="email" maxlength="50" placeholder="Enter Email Address" value="<?= $newUserRecord["Email"] ?>" required />
            <input type="password" name="password" minlength="5" placeholder="Enter Password" required />
            <input type="text" name="name" maxlength="50" placeholder="Enter Name" value="<?= $newUserRecord["Name"] ?>" required />
            <button class="btn btn-default" type="submit" name="register">Sign-up</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>