<?php  // Shop - List Cart Items
if (!isset($_SESSION["cart"][0])) :  // Check Cart has items ?>
  <div style="margin-bottom:50px">Your Shopping Cart is currently empty.</div>
<?php else : ?>
  <div class="table-responsive cart_info">
    <table class="table table-condensed" style="margin-bottom:0px">
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
          foreach ($_SESSION["cart"] as $key => $values) {
            if ($key == 0) { // Get Summary Details
              $cart0 = $values;
              continue;
            }
            if ($values["imgFilename"] == null || $values["imgFilename"] == "") {
              $fullPath = DEFAULTS["noImgUploaded"];
            } else {
              $fullPath = DEFAULTS["productsImgPath"] . $values["productID"] . "/" . $values["imgFilename"];
            }

            include "../app/views/shop/cartItem.php";
          }
        
          include "../app/views/shop/cartTotals.php";
        ?>
      </tbody>
    </table>
    <div style="margin-bottom:20px;">
      <a class="btn btn-default check_out" href="index.php?p=cart&mt">Empty Cart</a>
    </div>
  </div>
<?php endif;?>