<tr><!--Cart Item-->
  <td class="cart_product">
    <img width="100" height="93" src="<?= $fullPath; ?>" alt="<?= $value["imgFilename"]; ?>" />
  </td>
  <td class="cart_description">
    <h4><?= $value["name"]; ?></h4>
    <p>Web ID: <?= $value["productID"]; ?></p>
  </td>
  <td class="cart_price">
    <p><?= $locPrice; ?></p>
  </td>
  <td class="cart_quantity">
    <input class="cart_quantity_input" type="text" name="quantity" value="<?= $value["qtyOrdered"]; ?>" autocomplete="off" size="2" readonly />
  </td>
  <td class="cart_total">
    <p class="cart_total_price"><?= $itemPrice; ?></p>
  </td>
  <td class="cart_delete">
    <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
  </td>
</tr><!--/Cart Item-->