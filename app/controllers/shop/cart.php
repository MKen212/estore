<?php  // Shop - Shopping Cart

?>

<section id="cart_items"><!--cart_items-->
  <div class="container">
    <div class="breadcrumbs">
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Shopping Cart</li>
      </ol>
    </div>
    <?php  // Check Cart has Items
    if (!isset($_SESSION["cart"][0])) :?>
      <div style="margin-bottom:50px">Your Shopping Cart is currently empty.</div>
    <?php else :?>
      <div class="table-responsive cart_info">
        <table class="table table-condensed">
          <thead>
            <tr class="cart_menu">
              <td class="image">Item</td>
              <td class="description"></td>
              <td class="price">Unit Price</td>
              <td class="quantity">Quantity</td>
              <td class="total">Item Total</td>
              <td></td>
            </tr>
          </thead>
          <tbody>

          <?php  // Loop through Cart and output a row per item
            foreach ($_SESSION["cart"] as $key => $value) {
              if ($key == 0) { // Get Summary Details
                $cartTotal = DEFAULTS["localCurrency"] . " " . $value["cartValue"];
                continue;
              }
              if ($value["imgFilename"] == "") {
                $fullPath = DEFAULTS["noImgUploaded"];
              } else {
                $fullPath = DEFAULTS["productsImgPath"] . $value["productID"] . "/" . $value["imgFilename"];
              }
              $locPrice = DEFAULTS["localCurrency"] . " " . $value["priceLocal"];
              $itemPrice = DEFAULTS["localCurrency"] . " " . ($value["qtyOrdered"] * $value["priceLocal"]);

              include("../app/views/shop/cartItem.php");
            }
          ?>

          </tbody>
        </table>
      </div>
    <?php endif;?>
  </div>
</section><!--/cart_items-->

<?php  // Cart Summary
if (isset($_SESSION["cart"][0])) include("../app/views/shop/cartSummary.php");
?>