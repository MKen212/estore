<?php  // Shop - Products
// Get sub-page
isset($_GET["sp"]) ? $subPage = $_GET["sp"] : $subPage = 1;

// Get filter details
if (isset($_GET["cat"])) {
  if ($_GET["cat"] == 0) {  // Unset Category Filter if 0
    if (isset($_SESSION["prodCat"])) unset($_SESSION["prodCat"]);
  } else {  // Set Category Filter
    $_SESSION["prodCat"] = $_GET["cat"];
  }
}
if (isset($_GET["brand"])) {
  if ($_GET["brand"] == 0) {  // Unset Brand Filter if 0
    if (isset($_SESSION["prodBrand"])) unset($_SESSION["prodBrand"]);
  } else {  // Set Brand Filter
    $_SESSION["prodBrand"] = $_GET["brand"];
  }
}
$_GET = [];

// Get Total Active Records and Page Details
include_once "../app/models/productClass.php";
$product = new Product();

$totRecords = $product->count(1);
$lastPage = ceil($totRecords / DEFAULTS["productsPerPage"]);

if ($subPage > $lastPage) $subPage = $lastPage;
$curOffset = (($subPage - 1) * DEFAULTS["productsPerPage"]);
?>
<section>
  <div class="container">
    <div class="row">
      <div class="col-sm-3">
        <?php include "../app/views/shop/sidebar.php";?>
      </div>
      <div class="col-sm-9 padding-right">
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
      </div>
    </div>
  </div>
</section>