<?php  // Admin Dashboard - Product Category Add
include_once "../app/models/prodCatClass.php";
$prodCat = new ProdCat();

// Add Product Category Record if Add POSTed
if (isset($_POST["addProdCat"])) {
  $name = cleanInput($_POST["name"], "string");
  $status = cleanInput($_POST["status"], "int");

  // Create database entry
  $newProdCatID = $prodCat->add($name, $status);

  if ($newProdCatID) {  // Database Entry Success
    $_POST = [];
  }
}

// Initialise Product Category Record
$prodCatRecord = [
  "Name" => postValue("name"),
  "Status" => postValue("status", 1),
];

// Prep ProdCat Form Data
$formData = [
  "formUsage" => "Add",
  "formTitle" => "Add Product Category",
  "subName" => "addProdCat",
  "subText" => "Add Category",
];

// Show Product Category Form
include "../app/views/admin/prodCatForm.php";
?>