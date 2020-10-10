<tr class="cart_menu"><!--orderItemTotals-->
  <td></td>
  <td class="description">
    <h4>Sub-Totals:</h4>
  </td>
  <td class="price">
    <h4><?= $orderDetails["ItemCount"]; ?> Item(s)</h4>
  </td>
  <td class="quantity">
    <input class="cart_quantity_input" type="text" name="quantity" value="<?= $orderDetails["ProductCount"]; ?>"  size="2" readonly />
  </td>
  <td class="total">
    <h4><?= symValue($orderDetails["SubTotal"]); ?></h4>
  </td>
  <td></td>
  <td></td>
</tr><!--/orderItemTotals-->