<?php  // Admin - Register New User Form
include "../app/views/admin_login/registerForm.php";

if (isset($_POST["register"])) {  // Register New User
  $email = cleanInput($_POST["email"], "email");
  $password = cleanInput($_POST["password"], "password");
  $name = cleanInput($_POST["name"], "string");
  $_POST = [];

  include_once "../app/models/userClass.php";
  $user = new User();
  $newUser = $user->register($email, $password, $name);
  unset($user, $password);
  
  // Refresh page
  redirect("admin_login.php?p=register");
}
?>