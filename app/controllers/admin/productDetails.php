<?php  // Admin Dashboard - Product Details
if (!isset($_GET["id"])) $_GET["id"] = "0";  // Set ProductID to 0 if not provided
?>

<!-- Main Section - Product Details -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Product Details - ID: <?= $_GET["id"] ?></h2>
</div>

<?php
$id = cleanInput($_GET["id"], "int");
include_once "../app/models/productClass.php";
$product = new Product();

// Get Product Details for selected record
$productData = $product->getRecord($id);

if ($productData == false) {  // ProductID not found
  echo "<div>Product ID not found.</div>";
} else {
  // Show Product Form
  $formData = [
    "subName" => "updateProduct",
    "subText" => "Update Product",
  ];
  $productData["FullPath"] = getFilePath($productData["ProductID"], $productData["ImgFilename"]);
  include "../app/views/admin/productForm.php";

  if (isset($_POST["updateProduct"])) {  // Update Product Record
    // If Image File included - Perform initial checks on file
    if ($_FILES["imgFilename"]["error"] != 4) {  // File was Uploaded
      include_once "../app/models/uploadImgClass.php";
      $uploadImg = new UploadImg();
      $initialChecks = $uploadImg->initialChecks();
      if ($initialChecks != true) {
        ?><script>
          window.location.assign("admin_dashboard.php?p=productDetails&id=<?= $id ?>");
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
      $imgFilename = $productData["ImgFilename"];
    }
    $isNew = $_POST["isNew"];
    $isOnSale = $_POST["isOnSale"];
    $status = $_POST["status"];
    $_POST = [];

    if ($name == $productData["Name"]) $name = "";  // Unset $name if same as current record

    // Update database entry
    include_once "../app/models/productClass.php";
    $product = new Product();
    $updateProduct = $product->updateRecord($id, $name, $description, $prodCatID, $prodBrandID, $price, $weightGrams, $qtyAvail, $imgFilename, $isNew, $isOnSale, $status);

    if ($updateProduct) {  // Database Entry Success
      if ($_FILES["imgFilename"]["error"] == 0) {  // Image File included - Create dir & upload
        include_once "../app/models/uploadImgClass.php";
        $uploadImg = new UploadImg();
        $newUpload = $uploadImg->addProductImg($id, $imgFilename);
        $_FILES = [];
      } else {  // No Image File included
        $_SESSION["message"] = msgPrep("success", ($_SESSION["message"] . " No Image to upload."));
      }
    } else {  // Database Entry Failed
      // $_SESSION["message"] = msgPrep("danger", $_SESSION["message"]);  // Not Required as included in productClass
    }
    // Refresh page
    ?><script>
      window.location.assign("admin_dashboard.php?p=productDetails&id=<?= $id ?>");
    </script><?php
  }
}
?>