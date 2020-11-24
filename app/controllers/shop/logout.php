<?php  // Shop - Logout
include_once "../app/models/userClass.php";
$user = new User();
$user->logout();

unset($_SESSION["prodCatID"], $_SESSION["prodBrandID"]);
?>

<script>
  window.location.assign("index.php?p=home&q");
</script><?php