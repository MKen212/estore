<?php  // Admin Dashboard - ProdBrands List/Edit
include_once "../app/models/prodBrandClass.php";
$prodBrand = new ProdBrand();

// Get recordID if provided and process Status changes if hyperlinks clicked
$prodBrandID = 0;
if (isset($_GET["id"])) {
  $prodBrandID = $_GET["id"];

  if (isset($_GET["updStatus"])) {  // Status link was clicked
    $curStatus = cleanInput($_GET["cur"], "int");
    $newStatus = statusCycle("Status", $curStatus);
    // Update ProdBrand Status
    $updateStatus = $prodBrand->updateStatus($prodBrandID, $newStatus);
  }
}
$_GET = [];

// Fix ProdBrands Name Search if entered
$name = null;
if (isset($_POST["prodBrandSearch"])) {
  $name = fixSearch($_POST["schName"]);
}
$_POST = [];

// Get List of prod_brands
$prodBrandList = $prodBrand->getList($name);

// Display ProdBrands List View
include "../app/views/admin/prodBrandsList.php";
?>