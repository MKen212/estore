<?php  // Admin Dashboard - Product Brand Details
include_once "../app/models/prodBrandClass.php";
$prodBrand = new ProdBrand();

// Get recordID if provided
$prodBrandID = 0;
if (isset($_GET["id"])) {
  $prodBrandID = cleanInput($_GET["id"], "int");
}
$_GET = [];

// Update ProdBrand Record if Update POSTed
if (isset($_POST["updateProdBrand"])) {
  $name = cleanInput($_POST["name"], "string");
  $status = cleanInput($_POST["status"], "int");

  // Update database entry
  $updateProdbrand = $prodBrand->updateRecord($prodBrandID, $name, $status);
}
$_POST = [];

// Get Product Brand Details for selected record
$prodBrandRecord = $prodBrand->getRecord($prodBrandID);

// Prep ProdBrand Form
$formData = [
  "formUsage" => "Update",
  "formTitle" => "Product Brand Details - ID: " . $prodBrandID,
  "subName" => "updateProdBrand",
  "subText" => "Update Brand",
];

// Show ProdBrand Form
include "../app/views/admin/prodBrandForm.php";
?>