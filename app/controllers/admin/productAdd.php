<!-- Main Section - Admin Add Products -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Add Products</h2>
</div>

<?php  // Display Product Add Form
include("../app/views/admin/productForm.php");

if (isset($_POST["addProduct"])) {  // Add Products
  include_once("../app/models/productClass.php");

  // Perform File Upload Checks if Image File chosen
  if ($_FILES["imgFilename"]["error"] != 4) {
    // Check Temp Image Upload Errors
    if ($_FILES["imgFilename"]["error"] != 0) {
      if ($_FILES["imgFilename"]["error"] == 2) {
        $_SESSION["message"] = "Error - Image size larger than " . (DEFAULTS["maxUploadSize"] / 1000000) . " Mbyte(s).";
      } else {
        $_SESSION["message"] = "Error - Image upload error #" . $_FILES["imgFilename"]["error"] . ".";
      }
      $resultMsg = msgPrep("danger", $_SESSION["message"]);
      ?><script>
        document.getElementById("productAddRes").innerHTML = `<?= $resultMsg;?>`;
      </script><?php
      $_POST = [];
      $_FILES = [];
      unset($_SESSION["message"]);
      return;
    }
    // Check File Type to ensure it's an image
    $tmpFile = $_FILES["imgFilename"]["tmp_name"];
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $fileType = $finfo->file($tmpFile);
    if (strpos($fileType, "image") === false) {
      $_SESSION["message"] = "Error - Chosen File is not an image file.";
      $resultMsg = msgPrep("danger", $_SESSION["message"]);
      ?><script>
        document.getElementById("productAddRes").innerHTML = `<?= $resultMsg;?>`;
      </script><?php
      $_POST = [];
      $_FILES = [];
      unset($_SESSION["message"]);
      return;
    }
  }
  // Get Fields for database entry
  $name = cleanInput($_POST["name"], "string");
  $description = cleanInput($_POST["description"], "string");
  $category = cleanInput($_POST["category"], "string");
  $priceLocal = cleanInput($_POST["priceLocal"], "float");
  $weightGrams = cleanInput($_POST["weightGrams"], "int");
  $quantity = cleanInput($_POST["quantity"], "int");
  if ($_FILES["imgFilename"]["error"] == 0) {
    $imgFilename = md5(rand()) . "." . pathinfo($_FILES["imgFilename"]["name"], PATHINFO_EXTENSION);
  } else {
    $imgFilename = null;
  }
  $editUserID = $_SESSION["userID"];
  $_POST = [];
  $_FILES = [];

  // Create database entry
  $product = new Product();
  $addProduct = $product->add($name, $description, $category, $priceLocal, $weightGrams, $quantity, $imgFilename, $editUserID);
  if ($addProduct) {  // Database Entry Success
    if ($imgFilename) {  // Image File included - Create dir & upload
      $targetDir = DEFAULTS["productsImgPath"] . $addProduct . "/";
      $targetFile = $targetDir . $imgFilename;

      if (!file_exists($targetDir)) {
        mkdir($targetDir, 0750);
      }
      if (move_uploaded_file($tmpFile, $targetFile)) {
        // File Upload Success
        $_SESSION["message"] .= " Image successfully uploaded.";
        $resultMsg = msgPrep("success", $_SESSION["message"]);
      } else {
        // File Upload Failure
        $_SESSION["message"] .= " Warning: Image upload failed.";
        $resultMsg = msgPrep("warning", $_SESSION["message"]);
      }
    } else {  // No Image File included
      $_SESSION["message"] .= " No Image to upload.";
      $resultMsg = msgPrep("success", $_SESSION["message"]);
    }
  } else {  // Database Entry Failed
    $resultMsg = msgPrep("danger", $_SESSION["message"]);
  }
  ?><script>
    document.getElementById("productAddRes").innerHTML = `<?= $resultMsg;?>`;
  </script><?php
  unset($_SESSION["message"]);
}
?>