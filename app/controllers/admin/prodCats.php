<?php  // Admin Dashboard - ProdCats List/Edit
include_once "../app/models/prodCatClass.php";
$prodCat = new ProdCat();

// Get recordID if provided and process Status changes if hyperlinks clicked
$prodCatID = 0;
if (isset($_GET["id"])) {
  $prodCatID = cleanInput($_GET["id"], "int");

  if (isset($_GET["updStatus"])) {  // Status link was clicked
    $curStatus = cleanInput($_GET["cur"], "int");
    $newStatus = statusCycle("Status", $curStatus);
    // Update ProdCat Status
    $updateStatus = $prodCat->updateStatus($prodCatID, $newStatus);
  }
}
$_GET = [];

// Fix ProdCat Name Search if entered
$name = null;
if (isset($_POST["prodCatSearch"])){
  $name = fixSearch($_POST["schName"]);
}
$_POST = [];

// Get List of prod_categories
$prodCatList = $prodCat->getList($name);

// Display ProdCats List View
include "../app/views/admin/prodCatsList.php";
?>