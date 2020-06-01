<?php  // Logout User
include_once("../models/userClass.php");

if (isset($_GET["q"])) {
  $user = new User();
  $user->logout();
  $_GET = [];
  header("location:../views/user-logout.php");
  }
?>