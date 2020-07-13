<?php  // List Cart Items
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

            include("../app/views/shop/cartItem.php");
          }
        ?>

        <tr class="cart_menu"><!--sub_total-->
          <td></td>
          <td class="description">
            <h4>Cart Sub-Totals:</h4>
          </td>
          <td class="price">
            <h4><?= $cart0["items"]; ?> Item(s)</h4>
          </td>
          <td class="quantity">
            <input class="cart_quantity_input" type="text" name="quantity" value="<?= $cart0["products"]; ?>"  size="2" readonly />
          </td>
          <td class="total">
            <h4><?= symValue($cart0["subTotal"]); ?></h4>
          </td>
          <td></td>
        </tr><!--/sub_total-->
      </tbody>
    </table>
  </div>
<?php endif;?>