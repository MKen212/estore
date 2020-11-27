<?php  // Shop - Login
if (isset($_GET["r"])) {  // Check if return page is set
  $returnPage = $_GET["r"];
} else {
  $returnPage = "home";
}
?>

<section id="form"><!--form-->
  <div class="container">
    <div class="row">
      <div class="col-sm-12 bg">
        <h2 class="title text-center">Login / Sign-up</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4 col-sm-offset-1"><?php
        include "../app/views/shop/loginForm.php";

        if (isset($_POST["login"])) {  // Verify & Login User
          $email = cleanInput($_POST["estEmail"], "string");
          $password = cleanInput($_POST["estPassword"], "password");
          $_POST = [];

          include_once "../app/models/userClass.php";
          $user = new User();
          $login = $user->login($email, $password);
          unset($user, $password);
          if ($login == true) {
            // Login Success
            ?><script>
              window.location.assign("index.php?p=<?= $returnPage; ?>");
            </script><?php
          } else {
            // Login Failure
            msgShow();
          }
        } ?>
      </div>

      <div class="col-sm-1">
        <h2 class="or">OR</h2>
      </div>

      <div class="col-sm-4"><?php
        include "../app/views/shop/registerForm.php";
        
        if (isset($_POST["register"])) {  // Register New User
          $email = cleanInput($_POST["email"], "email");
          $password = cleanInput($_POST["password"], "password");
          $name = cleanInput($_POST["name"], "string");
          $_POST = [];

          include_once "../app/models/userClass.php";
          $user = new User();
          $newUser = $user->register($email, $password, $name);
          unset($user, $password);
          
          msgShow();
        } ?>
      </div>

    </div>
  </div>
</section><!--/form-->