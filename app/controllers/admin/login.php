<?php  // Display Login Form
include "../app/views/admin/loginForm.php";

if (isset($_POST["login"])){  // Verify & Login User
  include_once "../app/models/userClass.php";

  $username = cleanInput($_POST["estUsername"], "string");
  $password = cleanInput($_POST["estPassword"], "password");
  $_POST = [];

  $user = new User();  
  $login = $user->login($username, $password);
  unset($user, $password);  
  if ($login) {
    // Login Success
    header("location:admin_dashboard.php?p=home");
  } else {
    // Login Failure
    header("location:admin_login.php?p=logout");
  }
}
?>