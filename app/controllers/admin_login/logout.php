<?php  // Admin - Logout
if (isset($_GET["q"])) {
  include_once "../app/models/userClass.php";
  $user = new User();
  $user->logout();
}

include "../app/views/admin_login/logout.php";

if (isset($_GET["q"])) {
  session_unset();
  session_destroy();
}
$_GET = [];
?>