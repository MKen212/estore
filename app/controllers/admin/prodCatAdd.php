<!-- Admin Dashboard - Product Category Add -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Add Product Category</h2>
</div>

<?php
// Initialise Product Category Data
$prodCatData = [
  "Name" => null,
  "Status" => 1,
];

// Show ProdCat Form
$formData = [
  "subName" => "addProdCat",
  "subText" => "Add Category",
];
include "../app/views/admin/prodCatForm.php";

if (isset($_POST["addProdCat"])) {  // Add ProdCat Record
  // Clean Fields for DB Entry
  $name = cleanInput($_POST["name"], "string");
  $status = $_POST["status"];
  $_POST = [];

  // Create database entry
  include_once "../app/models/prodCatClass.php";
  $prodCat = new ProdCat();
  $newProdCatID = $prodCat->add($name, $status);

  // Refresh page
  ?><script>
    window.location.assign("admin_dashboard.php?p=prodCatAdd");
  </script><?php
}
?>