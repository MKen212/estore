<?php  // Shop - Products
include_once "../app/models/productClass.php";
$product = new Product();

// Get Product Filters and Search Data
include "../app/controllers/shop/productFilters.php";

// Get sub-page
$subPage = 1;
if (isset($_GET["sp"])) {
  $subPage = cleanInput($_GET["sp"], "int");
}
$_GET = [];

// Get Total Active Records and Page Details
$totRecords = $product->count(1, $prodCatID, $prodBrandID, $prodSearch);
if ($totRecords == 0) {  // No records returned
  $lastPage = 1;
} else {
  $lastPage = ceil($totRecords / DEFAULTS["productsPerPage"]);
}
if ($subPage > $lastPage) $subPage = $lastPage;
$curOffset = (($subPage - 1) * DEFAULTS["productsPerPage"]);

// Get Page of ACTIVE Products, as per selected filters
$productPage = $product->getPage(DEFAULTS["productsPerPage"], $curOffset, 1, $prodCatID, $prodBrandID, $prodSortID, $prodSearch);

// Get Product Carousel data (Random selection of 3 New & 3 Sale products)
$newProducts = $product->getCarousel(3, 1);
$saleProducts = $product->getCarousel(3, 2);

// Display Products Page View
include "../app/views/shop/productsPage.php";
?>