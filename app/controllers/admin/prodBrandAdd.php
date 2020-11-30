<?php  // Admin Dashboard - Product Brand Add
include_once "../app/models/prodBrandClass.php";
$prodBrand = new ProdBrand();

// Add Product Brand Record if Add POSTed
if (isset($_POST["addProdBrand"])) {
  $name = cleanInput($_POST["name"], "string");
  $status = cleanInput($_POST["status"], "int");

  // Create database entry
  $newProdBrandID = $prodBrand->add($name, $status);

  if ($newProdBrandID) {  // Database Entry Success
    $_POST = [];
  }
}

// Initialise Product Brand Data
$prodBrandRecord = [
  "Name" => postValue("name"),
  "Status" => postValue("status", 1),
];

// Prep ProdBrand Form
$formData = [
  "formUsage" => "Add",
  "formTitle" => "Add Product Brand",
  "subName" => "addProdBrand",
  "subText" => "Add Brand",
];

// Show Product Brand Form
include "../app/views/admin/prodBrandForm.php";
?>