<?php  // Logout User

if (isset($_GET["q"])) {
  include_once "../app/models/userClass.php";

  $user = new User();
  $user->logout();
}
$_GET = [];

include "../app/views/admin/logout.php";
?>
