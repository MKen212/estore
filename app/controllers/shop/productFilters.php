<?php  // Shop - Product Filters & Search
include_once "../app/models/prodCatClass.php";
$prodCat = new ProdCat();
include_once "../app/models/prodBrandClass.php";
$prodBrand = new ProdBrand();

// Update product sort and filter details, if set
if (isset($_GET["sort"])) {
  if ($_GET["sort"] == 0) {  // Unset Product Sort Option if 0
    if (isset($_SESSION["prodSortID"])) unset($_SESSION["prodSortID"]);
  } else {  // Set Product Sort Option
    $_SESSION["prodSortID"] = cleanInput($_GET["sort"], "int");
  }
  unset($_GET["sort"]);
}
if (isset($_GET["cat"])) {
  if ($_GET["cat"] == 0) {  // Unset Category Filter if 0
    if (isset($_SESSION["prodCatID"])) unset($_SESSION["prodCatID"]);
  } else {  // Set Category Filter
    $_SESSION["prodCatID"] = cleanInput($_GET["cat"], "int");
  }
  unset($_GET["cat"]);
}
if (isset($_GET["brand"])) {
  if ($_GET["brand"] == 0) {  // Unset Brand Filter if 0
    if (isset($_SESSION["prodBrandID"])) unset($_SESSION["prodBrandID"]);
  } else {  // Set Brand Filter
    $_SESSION["prodBrandID"] = cleanInput($_GET["brand"], "int");
  }
  unset($_GET["brand"]);
}

// Get product sort, filter and search settings from $_SESSION if set
isset($_SESSION["prodSortID"]) ? $prodSortID = $_SESSION["prodSortID"] : $prodSortID = 0;
isset($_SESSION["prodCatID"]) ? $prodCatID = $_SESSION["prodCatID"] : $prodCatID = null;
isset($_SESSION["prodBrandID"]) ? $prodBrandID = $_SESSION["prodBrandID"] : $prodBrandID = null;
isset($_SESSION["prodSearch"]) ? $prodSearch = fixSearch($_SESSION["prodSearch"]) : $prodSearch = null;

// Get product filter data
$prodCatData = $prodCat->getCategories(1);
$prodBrandData = $prodBrand->getBrands(1);
?>