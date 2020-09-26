<?php  // Shop - Products
include_once "../app/models/productClass.php";
$product = new Product();

// Get Total Active Records and Page Details
$totRecords = $product->count(1);
$lastPage = ceil($totRecords / DEFAULTS["productsPerPage"]);

isset($_GET["sp"]) ? $subPage = $_GET["sp"] : $subPage = 1;
if ($subPage > $lastPage) $subPage = $lastPage;
$curOffset = (($subPage - 1) * DEFAULTS["productsPerPage"]);

// Advert Removed as is hard-coded image
// include "../app/views/shop/advert.php";
?>

<div class="featured_items"><!-- featured_items -->
  <h2 class="title text-center">Featured Items</h2>

  <?php  // Loop through all ACTIVE Products and output a page of the values
  foreach (new RecursiveArrayIterator($product->getPage(DEFAULTS["productsPerPage"], $curOffset, 1)) as $record) {
    $record["FullPath"] = getFilePath($record["ProductID"], $record["ImgFilename"]);
    include "../app/views/shop/productItem.php";
  }
  ?>

  <!-- Pagination Section -->
  <div class="col-sm-12">
    <ul class="pagination">
      <?php pagination($subPage, $lastPage, "index.php?p=products&sp="); ?>
    </ul>
  </div>

</div><!--/featured_items-->