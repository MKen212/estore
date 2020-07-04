<?php  // Add Products

if (isset($_POST["addProduct"])) {
  include_once("../app/models/productClass.php");

  // Perform File Upload Checks if Image File chosen
  if ($_FILES["imgFilename"]["error"] != 4) {
    // Check Temp Image Upload Errors
    if ($_FILES["imgFilename"]["error"] != 0) {
      echo "<div class='alert alert-danger form-user'>";
      if ($_FILES["imgFilename"]["error"] == 2) {
        echo "Error - Image size larger than " . (DEFAULTS["maxUploadSize"] / 1000000) . " Mbyte(s).</div>";
      } else {
        echo "Error - Image upload error #" . $_FILES["imgFilename"]["error"] . ".</div>";
      }
      $_POST = [];
      $_FILES = [];
      return;
    }
    // Check File Type to ensure it's an image
    $tmpFile = $_FILES["imgFilename"]["tmp_name"];
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $fileType = $finfo->file($tmpFile);
    if (strpos($fileType, "image") === false) {
      echo "<div class='alert alert-danger form-user'>Error - Chosen File is not an image file.</div>";
      $_POST = [];
      $_FILES = [];
      return;
    }
  }
  // Get Fields for database entry
  $name = cleanInput($_POST["name"], "string");
  $description = cleanInput($_POST["description"], "string");
  $category = cleanInput($_POST["category"], "string");
  $priceLocal = cleanInput($_POST["priceLocal"], "float");
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
  $addProduct = $product->add($name, $description, $category, $priceLocal, $quantity, $imgFilename, $editUserID);
  if ($addProduct) {  // Database Entry Success
    if ($imgFilename) {  // Image File included - Create dir & upload
      $targetDir = DEFAULTS["productsImgPath"] . $addProduct . "/";
      $targetFile = $targetDir . $imgFilename;

      if (!file_exists($targetDir)) {
        mkdir($targetDir, 0750);
      }
      if (move_uploaded_file($tmpFile, $targetFile)) {
        // File Upload Success
        echo "<div class='alert alert-success form-user'>" .
          $_SESSION["message"] . 
          " Image successfully uploaded.</div>";
      } else {
        // File Upload Failure
        echo "<div class='alert alert-warning form-user'>" .
          $_SESSION["message"] . 
          " Warning: Image upload failed.</div>";
      }
    } else {  // No Image File included
      echo "<div class='alert alert-success form-user'>" .
        $_SESSION["message"] . 
        " No Image to upload.</div>";
    }
  } else {  // Database Entry Failed
    echo "<div class='alert alert-danger form-user'>" .
      $_SESSION["message"] . "</div>";
  }
}
?>