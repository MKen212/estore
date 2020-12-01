<?php  // Shop - Header
// Update Product Search if posted from Header
if (isset($_POST["hdrSearch"])) {
  if (empty($_POST["prodSearch"])) {
    unset($_SESSION["prodSearch"]);
  } else {
    $_SESSION["prodSearch"] = cleanInput($_POST["prodSearch"], "string");
  }
  unset($_POST["hdrSearch"], $_POST["prodSearch"]);
}

// Clear Product Search if reset posted
if (isset($_POST["hdrClear"])) {
  unset($_SESSION["prodSearch"]);
  unset($_POST["hdrClear"]);
}

// Display Header
include "../app/views/shop/header.php";
?>