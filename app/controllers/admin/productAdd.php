<?php  // Admin Dashboard - Product Add
include_once "../app/models/productClass.php";
$product = new Product();
include_once "../app/models/uploadImgClass.php";
$uploadImg = new UploadImg();

// Add Product Record if Add POSTed
if (isset($_POST["addProduct"])) {
  $initialChecks = 0;
  // If Image File included - Perform initial checks on file
  if ($_FILES["imgFilename"]["error"] != 4) {  // File was Uploaded
    $initialChecks = $uploadImg->initialChecks();
  }

  // Only continue with add if no file uploaded or initial checks passed
  if ($_FILES["imgFilename"]["error"] == 4 || $initialChecks == true) {
    $name = cleanInput($_POST["name"], "string");
    $description = cleanInput($_POST["description"], "string");
    $prodCatID = cleanInput($_POST["prodCatID"], "int");
    $prodBrandID = cleanInput($_POST["prodBrandID"], "int");
    $price = cleanInput($_POST["price"], "float");
    $weightGrams = cleanInput($_POST["weightGrams"], "int");
    $qtyAvail = cleanInput($_POST["qtyAvail"], "int");
    $imgFilename = createFilename();
    $flag = cleanInput($_POST["flag"], "int");
    $status = cleanInput($_POST["status"], "int");

    // Create database entry
    $newProductID = $product->add($name, $description, $prodCatID, $prodBrandID, $price, $weightGrams, $qtyAvail, $imgFilename, $flag, $status);

    if ($newProductID) {  // Database Entry Success
      $_POST = [];
      if ($_FILES["imgFilename"]["error"] == 0) {  // Image File included - Create dir & upload
        $newUpload = $uploadImg->addProductImg($newProductID, $imgFilename);
      } else {  // No Image File included
        $_SESSION["message"] = msgPrep("success", ($_SESSION["message"] . " No Image to upload."));
      }
      $_FILES = [];
    }
  }
}

// Initialise Product Record
$productRecord = [
  "Name" => postValue("name"),
  "Description" => postValue("description"),
  "ProdCatID" => postValue("prodCatID"),
  "ProdBrandID" => postValue("prodBrandID"),
  "Price" => postValue("price"),
  "WeightGrams" => postValue("weightGrams"),
  "QtyAvail" => postValue("qtyAvail"),
  "Flag" => postValue("flag", 1),
  "Status" => postValue("status", 1),
];

// Prep Product Form Data
$formData = [
  "formUsage" => "Add",
  "formTitle" => "Add Product",
  "subName" => "addProduct",
  "subText" => "Add Product",
];

// Show Product Form
include "../app/views/admin/productForm.php";
?>