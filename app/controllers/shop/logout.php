<?php  // Shop - Logout
unset($_SESSION["userLogin"], $_SESSION["userIsAdmin"], $_SESSION["userID"], $_SESSION["userName"], $_SESSION["prodCatID"], $_SESSION["prodBrandID"]);
?>

<script>
  window.location.assign("index.php?p=home&q");
</script><?php