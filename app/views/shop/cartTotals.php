<tr class="cart_menu"><!--sub_total-->
  <td></td>
  <td class="description">
    <h4>Cart Sub-Totals:</h4>
  </td>
  <td class="price">
    <h4><?= $cart0["itemCount"]; ?> Item(s)</h4>
  </td>
  <td class="quantity">
    <input class="cart_quantity_input" type="text" name="quantity" value="<?= $cart0["productCount"]; ?>"  size="2" readonly />
  </td>
  <td class="total">
    <h4><?= symValue($cart0["subTotal"]); ?></h4>
  </td>
  <td></td>
</tr><!--/sub_total-->