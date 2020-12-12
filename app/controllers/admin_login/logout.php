<?php  // Admin - Logout
include_once "../app/models/userClass.php";
$user = new User();

// Logout User if logout hyperlink clicked
if (isset($_GET["q"])) {
  $user->logout();
}

// Show Logout Page
include "../app/views/admin_login/logout.php";

// Clear Session
if (isset($_GET["q"])) {
  session_unset();
  session_destroy();
}
$_GET = [];
?>