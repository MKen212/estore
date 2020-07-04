<?php // Shop - Product Details
include_once("../app/models/productClass.php");
$product = new Product();

isset($_GET["id"]) ? $selectedID = $_GET["id"] : $selectedID = 1;
$value = $product->getRecord($selectedID);  // Get Product Details

if ($value["ImgFilename"] == "") {
  $fullPath = DEFAULTS["noImgUploaded"];
} else {
  $fullPath = DEFAULTS["productsImgPath"] . $value["ProductID"] . "/" . $value["ImgFilename"];
}
$locPrice = DEFAULTS["localCurrency"] . " " . $value["PriceLocal"];
$quantity = $value["QtyAvail"] > 0 ? 1 : 0;

// If Add-To-Cart POSTed then update SESSION variables
if (isset($_POST["addProdToCart"])) {
  $qtyordered = cleanInput($_POST["qtyOrdered"], "int");
  $_POST=[];

  addToCart($value["ProductID"], $value["PriceLocal"], $qtyordered);
  ?>
  <script>
    document.getElementById("cartItems").innerHTML = <?= $_SESSION["cart"][0]["cartItems"];?>;
  </script>
  <?php
}

include("../app/views/shop/productInfo.php");
?>
