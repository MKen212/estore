<?php  // Verify & Login User
include_once("../models/userClass.php");

if (isset($_POST["login"])){
  $username = cleanInput($_POST["estUsername"], "string");
  $password = cleanInput($_POST["estPassword"], "password");
  $_POST = [];

  $user = new User();  
  $login = $user->login($username, $password);
  unset($user, $password);  
  if ($login) {
    // Login Success
    header("location:../views/admin.php");
  } else {
    // Login Failure
    header("location:../views/user-logout.php");
  }
}
?>