<?php  // Shop - Logout
session_unset();
session_destroy();
?>

<script>
  window.location.assign("index.php?p=home&q");
</script><?php