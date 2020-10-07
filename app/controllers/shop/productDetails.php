<?php  // Shop - Product Details
include_once "../app/models/productClass.php";
$product = new Product();

isset($_GET["id"]) ? $selectedID = $_GET["id"] : $selectedID = 1;
$record = $product->getRecordView($selectedID);  // Get Product Details from View

$record["FullPath"] = getFilePath($record["ProductID"], $record["ImgFilename"]);
$quantity = $record["QtyAvail"] > 0 ? 1 : 0;

include "../app/views/shop/productDetail.php";

// If Add-To-Cart POSTed then update SESSION variables
if (isset($_POST["addProdToCart"])) {
  $qtyordered = cleanInput($_POST["qtyOrdered"], "int");
  $_POST=[];

  addToCart($selectedID, $record["Name"], $record["Price"], $record["WeightGrams"], $qtyordered, $record["ImgFilename"]);
  ?><script>
    document.getElementById("cartItems").innerHTML = <?= $_SESSION["cart"][0]["itemCount"];?>;
  </script><?php
}

?>
