<tr><!--order_item-->
  <td class="cart_product">
    <img width="100" height="93" src="<?= $fullPath; ?>" alt="<?= $values["ImgFilename"]; ?>" />
  </td>
  <td class="cart_description">
    <h4><?= $values["Name"]; ?></h4>
    <p>Web ID: <?= $values["ProductID"]; ?></p>
  </td>
  <td class="cart_price">
    <p><?= symValue($values["Price"]); ?></p>
  </td>
  <td class="cart_quantity">
    <input class="cart_quantity_input" type="text" name="quantity" value="<?= $values["QtyOrdered"]; ?>" autocomplete="off" size="2" readonly />
  </td>
  <td class="cart_total">
    <p class="cart_total_price"><?= symValue(($values["QtyOrdered"] * $values["Price"])); ?></p>
  </td>
</tr><!--/order_item-->