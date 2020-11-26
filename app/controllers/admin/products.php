<?php  // Admin Dashboard - Products List/Edit
include_once "../app/models/productClass.php";
$product = new Product();

// Get recordID if provided and process Status changes if hyperlinks clicked
$productID = 0;
if (isset($_GET["id"])) {
  $productID = cleanInput($_GET["id"], "int");

  if (isset($_GET["updStatus"])) {  // Status link was clicked
    $curStatus = cleanInput($_GET["cur"], "int");
    $newStatus = statusCycle("Status", $curStatus);
    // Update Product Status
    $updateStatus = $product->updateStatus($productID, $newStatus);

  } elseif (isset($_GET["updFlag"])) {  // Flag link was clicked
    $curStatus = cleanInput($_GET["cur"], "int");
    $newStatus = statusCycle("Flag", $curStatus);
    // Update Product Flag
    $updateStatus = $product->updateFlag($productID, $newStatus);
  }
} 
$_GET = [];

// Fix Product Name Search if entered
$name = null;
if (isset($_POST["productSearch"])){
  $name = fixSearch($_POST["schProduct"]);
}
$_POST = [];

// Get List of products
$productList = $product->getList($name);

// Display Products List View
include "../app/views/admin/productsList.php";
?>