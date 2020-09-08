<?php  // Admin Dashboard - Product Details
if (!isset($_GET["id"])) $_GET["id"] = "0";  // Set ProductID to 0 if not provided
?>

<!-- Main Section - Product Details -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Product Details - Product ID: <?= $_GET["id"] ?></h2>
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
  if (empty($productData["ImgFilename"])) {
    $fullPath = DEFAULTS["noImgUploaded"];
  } else {
    $fullPath = DEFAULTS["productsImgPath"] . $id . "/" . $productData["ImgFilename"];
  }  
  include "../app/views/admin/productForm.php";

  // TO HERE  - NEED TO UPDATE DB FOLLOWING UPDATE

}

?>