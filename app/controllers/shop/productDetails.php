<?php  // Shop - Product Details
include_once "../app/models/productClass.php";
$product = new Product();

// Get Product Filters and Search Data
include "../app/controllers/shop/productFilters.php";

// Get recordID if provided 
$productID = 0;
if (isset($_GET["id"])) {
  $productID = cleanInput($_GET["id"], "int");
}
$_GET = [];

// If Add-To-Cart POSTed then update SESSION variables
if (isset($_POST["addProdToCart"])) {
  $name = cleanInput($_POST["name"], "string");
  $price = cleanInput($_POST["price"], "float");
  $weightGrams = cleanInput($_POST["weightGrams"], "int");
  $qtyOrdered = cleanInput($_POST["qtyOrdered"], "int");
  $imgFilename = cleanInput($_POST["imgFilename"], "string");

  // Add Product to Cart
  addToCart($productID, $name, $price, $weightGrams, $qtyOrdered, $imgFilename);

  // Update Header / Cart Items ?>
  <script>
    document.getElementById("cartItems").innerHTML = <?= $_SESSION["cart"][0]["itemCount"] ?>;
  </script><?php
}
$_POST = [];

// Get Selected Product Details
$productRecord = $product->getRecordView($productID);
// Update Qty Allowed to Order based on Qty Available
if (!empty($productRecord)) {
  if ($productRecord["QtyAvail"] > 0) {
    $productRecord["QtyAllowed"] = 1;
  } else {
    $productRecord["QtyAllowed"] = 0;
  }
}

// Get Product Carousel data (Random selection of 3 New & 3 Sale ACTIVE products)
$newProducts = $product->getCarousel(3, 1, 1);
$saleProducts = $product->getCarousel(3, 2, 1);

// Show Product Details View
include "../app/views/shop/productDetails.php";
?>