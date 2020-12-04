<?php  // Admin Dashboard - Product Details
include_once "../app/models/productClass.php";
$product = new Product();
include_once "../app/models/uploadImgClass.php";
$uploadImg = new UploadImg();

// Get recordID if provided
$productID = 0;
if (isset($_GET["id"])) {
  $productID = cleanInput($_GET["id"], "int");
}
$_GET = [];

// Update Product Record & Upload new image if Update POSTed
if (isset($_POST["updateProduct"])) {
  $initialChecks = 0;
  // If Image File included - Perform initial checks on file
  if ($_FILES["imgFilename"]["error"] != 4) {  // File was Uploaded
    $initialChecks = $uploadImg->initialChecks();
  }

  // Only continue with updates if no file uploaded or initial checks passed
  if ($_FILES["imgFilename"]["error"] == 4 || $initialChecks == true) {
    $name = cleanInput($_POST["name"], "string");
    $description = cleanInput($_POST["description"], "string");
    $prodCatID = cleanInput($_POST["prodCatID"], "int");
    $prodBrandID = cleanInput($_POST["prodBrandID"], "int");
    $price = cleanInput($_POST["price"], "float");
    $weightGrams = cleanInput($_POST["weightGrams"], "int");
    $qtyAvail = cleanInput($_POST["qtyAvail"], "int");
    $flag = cleanInput($_POST["flag"], "int");
    $status = cleanInput($_POST["status"], "int");

    $imgFilename = createFilename();
    if ($imgFilename == null) $imgFilename = $_POST["origImgFilename"];

    // Update database entry
    $updateProduct = $product->updateRecord($productID, $name, $description, $prodCatID, $prodBrandID, $price, $weightGrams, $qtyAvail, $imgFilename, $flag, $status);

    if ($updateProduct == true) {  // Database Update Success
      if ($_FILES["imgFilename"]["error"] == 0) {  // Image File included - Create dir & upload
        $newUpload = $uploadImg->addProductImg($productID, $imgFilename);
      } else {  // No Image File included
        $_SESSION["message"] = msgPrep("success", ($_SESSION["message"] . " No Image to upload."));
      }
    }
  }
}
$_POST = [];
$_FILES = [];

// Get Product Details for selected record
$productRecord = $product->getRecord($productID);

// Prep Product Form Data
$formData = [
  "formUsage" => "Update",
  "formTitle" => "Product Details - ID: {$productID}",
  "subName" => "updateProduct",
  "subText" => "Update Product",
];

// Show Product Form
include "../app/views/admin/productForm.php";
?>