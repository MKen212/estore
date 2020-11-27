<?php  // Shop - Products
// Get sub-page
isset($_GET["sp"]) ? $subPage = $_GET["sp"] : $subPage = 1;

// Update product sort and filter details
if (isset($_GET["sort"])) {
  if ($_GET["sort"] == 0) {  // Unset Product Sort Option if 0
    if (isset($_SESSION["prodSortID"])) unset($_SESSION["prodSortID"]);
  } else {  // Set Product Sort Option
    $_SESSION["prodSortID"] = $_GET["sort"];
  }
}
if (isset($_GET["cat"])) {
  if ($_GET["cat"] == 0) {  // Unset Category Filter if 0
    if (isset($_SESSION["prodCatID"])) unset($_SESSION["prodCatID"]);
  } else {  // Set Category Filter
    $_SESSION["prodCatID"] = $_GET["cat"];
  }
}
if (isset($_GET["brand"])) {
  if ($_GET["brand"] == 0) {  // Unset Brand Filter if 0
    if (isset($_SESSION["prodBrandID"])) unset($_SESSION["prodBrandID"]);
  } else {  // Set Brand Filter
    $_SESSION["prodBrandID"] = $_GET["brand"];
  }
}
$_GET = [];

// Get product sort, filter and search details from $_SESSION if set
isset($_SESSION["prodSortID"]) ? $prodSortID = $_SESSION["prodSortID"] : $prodSortID = 0;
isset($_SESSION["prodCatID"]) ? $prodCatID = $_SESSION["prodCatID"] : $prodCatID = null;
isset($_SESSION["prodBrandID"]) ? $prodBrandID = $_SESSION["prodBrandID"] : $prodBrandID = null;
isset($_SESSION["prodSearch"]) ? $prodSearch = fixSearch($_SESSION["prodSearch"]) : $prodSearch = null;

// Get Total Active Records and Page Details
include_once "../app/models/productClass.php";
$product = new Product();

$totRecords = $product->count(1, $prodCatID, $prodBrandID, $prodSearch);
$lastPage = ceil($totRecords / DEFAULTS["productsPerPage"]);

if ($subPage > $lastPage) $subPage = $lastPage;
$curOffset = (($subPage - 1) * DEFAULTS["productsPerPage"]);
?>
<section>
  <div class="container">
    <div class="row">
      <div class="col-sm-3"><?php
        include "../app/views/shop/sidebar.php";?>
      </div>
      <div class="col-sm-9 padding-right">
        <div class="featured_items"><!-- featured_items -->
          <h2 class="title text-center">Our Products</h2><?php
          if ($totRecords == 0) :  // No records to show ?>
            <div class="register-req">
              <p>Sorry - No products to show. Check Category or Brand Filters if you were expecting products to be listed.</p>
            </div><?php
          else :
            // Loop through all ACTIVE Products (as per filters) and output a page of the values
            foreach (new RecursiveArrayIterator($product->getPage(DEFAULTS["productsPerPage"], $curOffset, 1, $prodCatID, $prodBrandID, $prodSortID, $prodSearch)) as $record) {
              $record["FullPath"] = getFilePath($record["ProductID"], $record["ImgFilename"]);
              include "../app/views/shop/productItem.php";
            }?>

            <!-- Pagination Section -->
            <div class="col-sm-12">
              <ul class="pagination"><?php
                pagination($subPage, $lastPage, "index.php?p=products&sp="); ?>
              </ul>
            </div><?php
          endif; ?>
        </div><!--/featured_items--><?php
        
        // Show Product New/OnSale Carousel
        include "../app/controllers/shop/productCarousel.php";
        ?>
        
      </div>
    </div>
  </div>
</section>