<?php  // Shop - Product Details
if (!isset($_GET["id"])) :  // Check ProductID Provided ?>
  <div class="register-req">
    <p>No Product ID provided.</p>
  </div>
<?php else :
  $selectedID = $_GET["id"];
  $_GET = [];
  include_once "../app/models/productClass.php";
  $product = new Product();

  $record = $product->getRecordView($selectedID);  // Get Product Details from View
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
  endif;
endif; ?>
