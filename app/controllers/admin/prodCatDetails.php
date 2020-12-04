<?php  // Admin Dashboard - Product Category Details
include_once "../app/models/prodCatClass.php";
$prodCat = new ProdCat();

// Get recordID if provided
$prodCatID = 0;
if (isset($_GET["id"])) {
  $prodCatID = cleanInput($_GET["id"], "int");
}
$_GET = [];

// Update ProdCat Record if Update POSTed
if (isset($_POST["updateProdCat"])) {
  $name = cleanInput($_POST["name"], "string");
  $status = cleanInput($_POST["status"], "int");

  // Update database entry
  $updateProdCat = $prodCat->updateRecord($prodCatID, $name, $status);
}
$_POST = [];

// Get Product Category Details for selected record
$prodCatRecord = $prodCat->getRecord($prodCatID);

// Prep ProdCat Form Data
$formData = [
  "formUsage" => "Update",
  "formTitle" => "Product Category Details - ID: {$prodCatID}",
  "subName" => "updateProdCat",
  "subText" => "Update Category",
];

// Show ProdCat Form
include "../app/views/admin/prodCatForm.php";
?>