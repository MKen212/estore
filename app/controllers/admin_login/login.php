<?php  // Admin - Login
include "../app/views/admin_login/loginForm.php";

if (isset($_POST["login"])){  // Verify & Login User
  $email = cleanInput($_POST["estEmail"], "string");
  $password = cleanInput($_POST["estPassword"], "password");
  $_POST = [];

  include_once "../app/models/userClass.php";
  $user = new User();  
  $login = $user->login($email, $password);
  unset($user, $password);  
  if ($login == true) {
    // Login Success
    redirect("admin_dashboard.php?p=home");
  } else {
    // Login Failure
    redirect("admin_login.php?p=logout");
  }
}
?>