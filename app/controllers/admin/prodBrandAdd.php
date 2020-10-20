<!-- Admin Dashboard - Product Brand Add -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Add Product Brand</h2>
</div>

<?php
// Initialise Product Brand Data
$prodBrandData = [
  "Name" => null,
  "Status" => 0,
];

// Show ProdBrand Form
$formData = [
  "subName" => "addProdBrand",
  "subText" => "Add Brand",
];
include "../app/views/admin/prodBrandForm.php";

if (isset($_POST["addProdBrand"])) {  // Add ProdBrand Record
  // Clean Fields for DB Entry
  $name = cleanInput($_POST["name"], "string");
  $status = $_POST["status"];
  $_POST = [];

  // Create database entry
  include_once "../app/models/prodBrandClass.php";
  $prodBrand = new ProdBrand();
  $newProdBrandID = $prodBrand->add($name, $status);

  // Refresh page
  ?><script>
    window.location.assign("admin_dashboard.php?p=prodBrandAdd");
  </script><?php
}
?>