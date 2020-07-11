<?php  // Shop - Product Details
include_once("../app/models/productClass.php");
$product = new Product();

isset($_GET["id"]) ? $selectedID = $_GET["id"] : $selectedID = 1;
$values = $product->getRecord($selectedID);  // Get Product Details

if ($values["ImgFilename"] == null || $values["ImgFilename"] == "") {
  $fullPath = DEFAULTS["noImgUploaded"];
} else {
  $fullPath = DEFAULTS["productsImgPath"] . $selectedID . "/" . $values["ImgFilename"];
}
$quantity = $values["QtyAvail"] > 0 ? 1 : 0;

include("../app/views/shop/productInfo.php");

// If Add-To-Cart POSTed then update SESSION variables
if (isset($_POST["addProdToCart"])) {
  $qtyordered = cleanInput($_POST["qtyOrdered"], "int");
  $_POST=[];

  addToCart($selectedID, $values["Name"], $values["PriceLocal"], $qtyordered, $values["ImgFilename"]);
  ?><script>
    document.getElementById("cartItems").innerHTML = <?= $_SESSION["cart"][0]["cartItems"];?>;
  </script><?php
}

?>
