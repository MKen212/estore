<?php  // Admin - Login
include_once "../app/models/userClass.php";
$user = new User();  

// Verify & Login User if Login Form POSTed
if (isset($_POST["login"])){
  $email = cleanInput($_POST["estEmail"], "string");
  $password = cleanInput($_POST["estPassword"], "password");
  $_POST = [];

  // Check database against user entry
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

// Show Login Form
include "../app/views/admin_login/loginForm.php";
?>