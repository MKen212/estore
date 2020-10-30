<?php  // Shop - Product Details
if (!isset($_GET["id"])) $_GET["id"] = "0";  // Set ProductID to 0 if not provided
$selectedID = $_GET["id"];

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

// Get Product Details from View
include_once "../app/models/productClass.php";
$product = new Product();

$record = $product->getRecordView($selectedID);
?>
<section>
  <div class="container">
    <div class="row">
      <div class="col-sm-3">
        <?php include "../app/views/shop/sidebar.php";?>
      </div>
      <div class="col-sm-9 padding-right">
        <?php
        if (empty($record)) :  // Check Product is found ?>
          <div class="register-req">
            <p>Sorry - Product ID '<?= $selectedID ?>' not found.</p>
          </div>
        <?php elseif ($record["Status"] == 0) :  // Check Product is not Inactive ?>
          <div class="register-req">
            <p>Sorry - Product ID '<?= $selectedID ?>' is marked as 'Inactive'.</p>
          </div>
        <?php else :
          $record["FullPath"] = getFilePath($record["ProductID"], $record["ImgFilename"]);
          $quantity = $record["QtyAvail"] > 0 ? 1 : 0;

          include "../app/views/shop/productDetail.php";

          // If Add-To-Cart POSTed then update SESSION variables
          if (isset($_POST["addProdToCart"])) :
            $qtyordered = cleanInput($_POST["qtyOrdered"], "int");
            $_POST=[];

            addToCart($selectedID, $record["Name"], $record["Price"], $record["WeightGrams"], $qtyordered, $record["ImgFilename"]);
            ?><script>
              document.getElementById("cartItems").innerHTML = <?= $_SESSION["cart"][0]["itemCount"];?>;
            </script><?php
          endif;
        endif; ?>
      </div>
    </div>
  </div>
</section>