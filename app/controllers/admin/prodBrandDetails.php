<?php  // Admin Dashboard - Product Brand Details
if (!isset($_GET["id"])) $_GET["id"] = "0";  // Set ProdBrandID to 0 if not provided
?>

<!-- Main Section - Product Brand Details -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Product Brand Details - ID: <?= $_GET["id"] ?></h2>
</div>

<?php
$id = cleanInput($_GET["id"], "int");
include_once "../app/models/prodBrandClass.php";
$prodBrand = new ProdBrand();

// Get Product Brand Details for selected record
$prodBrandData = $prodBrand->getRecord($id);

if ($prodBrandData == false) {  // ProdBrandID not found
  echo "<div>Product Brand ID not found.</div>";
} else {
  // Show ProdBrand Form
  $formData = [
    "subName" => "updateProdBrand",
    "subText" => "Update Brand",
  ];
  include "../app/views/admin/prodBrandForm.php";

  if (isset($_POST["updateProdBrand"])) {  // Update ProdBrand Record
    $name = cleanInput($_POST["name"], "string");
    $status = $_POST["status"];
    $_POST = [];

    if ($name == $prodBrandData["Name"]) $name = "";  // Unset $name if same as current record

    include_once "../app/models/prodBrandClass.php";
    $prodBrand = new ProdBrand();
    $updateProdbrand = $prodBrand->updateRecord($id, $name, $status);
    // Refresh page
    ?><script>
      window.location.assign("admin_dashboard.php?p=prodBrandDetails&id=<?= $id ?>");
    </script><?php
  }
}
?>