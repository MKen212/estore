<!-- Admin Dashboard - Product Add -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Add Product</h2>
</div>

<?php
// Initialise Product Data
$productData = [
  "Name" => null,
  "Description" => null,
  "ProdCatID" => 0,
  "ProdBrandID" => 0,
  "Price" => null,
  "WeightGrams" => null,
  "QtyAvail" => null,
  "Flag" => 1,
  "Status" => 1,
];

// Display Product Add Form
$formData = [
  "subName" => "addProduct",
  "subText" => "Add Product",
];
include "../app/views/admin/productForm.php";

if (isset($_POST["addProduct"])) {  // Add Products
  // If Image File included - Perform initial checks on file
  if ($_FILES["imgFilename"]["error"] != 4) {  // File was Uploaded
    include_once "../app/models/uploadImgClass.php";
    $uploadImg = new UploadImg();
    $initialChecks = $uploadImg->initialChecks();
    if ($initialChecks != true) {
      ?><script>
        window.location.assign("admin_dashboard.php?p=productAdd");
      </script><?php
      return;
    }
  }

  // Initial checks passed or no file uploaded - Clean Fields for DB entry
  $name = cleanInput($_POST["name"], "string");
  $description = cleanInput($_POST["description"], "string");
  $prodCatID = $_POST["prodCatID"];
  $prodBrandID = $_POST["prodBrandID"];
  $price = cleanInput($_POST["price"], "float");
  $weightGrams = cleanInput($_POST["weightGrams"], "int");
  $qtyAvail = cleanInput($_POST["qtyAvail"], "int");
  if ($_FILES["imgFilename"]["error"] == 0) {
    $imgFilename = md5(rand()) . "." . pathinfo($_FILES["imgFilename"]["name"], PATHINFO_EXTENSION);
  } else {
    $imgFilename = null;
  }
  $flag = $_POST["flag"];
  $status = $_POST["status"];
  $_POST = [];

  // Create database entry
  include_once "../app/models/productClass.php";
  $product = new Product();
  $newProductID = $product->add($name, $description, $prodCatID, $prodBrandID, $price, $weightGrams, $qtyAvail, $imgFilename, $flag, $status);

  if ($newProductID) {  // Database Entry Success
    if ($_FILES["imgFilename"]["error"] == 0) {  // Image File included - Create dir & upload
      include_once "../app/models/uploadImgClass.php";
      $uploadImg = new UploadImg();
      $newUpload = $uploadImg->addProductImg($newProductID, $imgFilename);
      $_FILES = [];
    } else {  // No Image File included
      $_SESSION["message"] = msgPrep("success", ($_SESSION["message"] . " No Image to upload."));
    }
  } else {  // Database Entry Failed
    // $_SESSION["message"] = msgPrep("danger", $_SESSION["message"]);  // Not Required as included in productClass
  }

  // Refresh page
  ?><script>
    window.location.assign("admin_dashboard.php?p=productAdd");
  </script><?php
}
?>