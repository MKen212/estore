<?php  // Admin Dashboard - Product Category Details
if (!isset($_GET["id"])) $_GET["id"] = "0";  // Set ProdCatID to 0 if not provided
?>

<!-- Main Section - Product Category Details -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Product Category Details - ID: <?= $_GET["id"] ?></h2>
</div>

<?php
$id = cleanInput($_GET["id"], "int");
include_once "../app/models/prodCatClass.php";
$prodCat = new ProdCat();

// Get Product Category Details for selected record
$prodCatData = $prodCat->getRecord($id);

if ($prodCatData == false) {  // ProdCatID not found
  echo "<div>ProdCat ID not found.</div>";
} else {
  // Show ProdCat Form
  $formData = [
    "subName" => "updateProdCat",
    "subText" => "Update Category",
  ];
  include "../app/views/admin/prodCatForm.php";

  if (isset($_POST["updateProdCat"])) {  // Update ProdCat Record
    $name = cleanInput($_POST["name"], "string");
    $status = $_POST["status"];
    $_POST = [];

    if ($name == $prodCatData["Name"]) $name = "";  // Unset $name if same as current record

    include_once "../app/models/prodCatClass.php";
    $prodCat = new ProdCat();
    $updateProdCat = $prodCat->updateRecord($id, $name, $status);
    // Refresh page
    ?><script>
      window.location.assign("admin_dashboard.php?p=prodCatDetails&id=<?= $id ?>");
    </script><?php
  }
}
?>