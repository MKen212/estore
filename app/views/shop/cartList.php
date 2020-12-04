<!-- Cart List - SHOP -->
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
    <tbody><?php
      // Loop through Cart and output a row per item
      foreach ($_SESSION["cart"] as $key => $values) :
        if ($key == 0) { // Skip Cart Summary
          continue;
        } ?>
        <!-- Cart Item -->
        <tr>
          <td class="cart_product">
            <img width="100" height="93" src="<?= getFilePath($values["productID"], $values["imgFilename"]) ?>" alt="<?= $values["imgFilename"] ?>" />
          </td>
          <td class="cart_description">
            <h4><?= $values["name"] ?></h4>
            <p>Product ID: <?= $values["productID"] ?></p>
          </td>
          <td class="cart_price">
            <p><?= symValue($values["price"]) ?></p>
          </td>
          <td class="cart_quantity">
            <input class="cart_quantity_input" type="text" name="quantity" value="<?= $values["qtyOrdered"] ?>" autocomplete="off" size="2" readonly />
          </td>
          <td class="cart_total">
            <p class="cart_total_price"><?= symValue(($values["qtyOrdered"] * $values["price"])) ?></p>
          </td>
          <td class="cart_delete">
            <a class="cart_quantity_delete" href="index.php?p=cart&delItem&id=<?= $values["itemID"] ?>"><i class="fa fa-times"></i></a>
          </td>
        </tr><?php
      endforeach; ?>
      <!-- Cart List Sub-Totals -->
      <tr class="cart_menu">
        <td></td>
        <td class="description">
          <h4>Cart Sub-Totals:</h4>
        </td>
        <td class="price">
          <h4><?= $_SESSION["cart"][0]["itemCount"] ?> Item(s)</h4>
        </td>
        <td class="quantity">
          <input class="cart_quantity_input" type="text" name="quantity" value="<?= $_SESSION["cart"][0]["productCount"] ?>"  size="2" readonly />
        </td>
        <td class="total">
          <h4><?= symValue($_SESSION["cart"][0]["subTotal"]) ?></h4>
        </td>
        <td></td>
      </tr>
    </tbody>
  </table>

  <!-- Cart List Footer Buttons -->
  <div style="text-align:right; margin-right:25px; margin-bottom:20px;">
    <a class="btn btn-default check_out" href="index.php?p=cart&mt">Empty Cart</a><?php
    if ($checkoutButton == true) :  // Display Checkout Button if required ?>
      <a class="btn btn-default check_out" href="index.php?p=checkout">Proceed to Checkout</a><?php
    endif; ?>
  </div>
</div>