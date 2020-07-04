<?php  // Logout User

if (isset($_GET["q"])) {
  include_once("../app/models/userClass.php");

  $user = new User();
  $user->logout();
  $_GET = [];
  
  header("location:admin_login.php?p=logout");
  }
?>