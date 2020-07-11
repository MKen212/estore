<tr><!--Cart Item-->
  <td class="cart_product">
    <img width="100" height="93" src="<?= $fullPath; ?>" alt="<?= $values["imgFilename"]; ?>" />
  </td>
  <td class="cart_description">
    <h4><?= $values["name"]; ?></h4>
    <p>Web ID: <?= $values["productID"]; ?></p>
  </td>
  <td class="cart_price">
    <p><?= symValue($values["priceLocal"]); ?></p>
  </td>
  <td class="cart_quantity">
    <input class="cart_quantity_input" type="text" name="quantity" value="<?= $values["qtyOrdered"]; ?>" autocomplete="off" size="2" readonly />
  </td>
  <td class="cart_total">
    <p class="cart_total_price"><?= symValue(($values["qtyOrdered"] * $values["priceLocal"])); ?></p>
  </td>
  <td class="cart_delete">
    <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
  </td>
</tr><!--/Cart Item-->