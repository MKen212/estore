<tr class="cart_menu"><!--returnItemTotals_SHOP-->
  <td></td>
  <td class="description">
    <h4>Sub-Totals:</h4>
  </td>
  <td class="price">
    <h4><?= $returnDetails["ItemCount"]; ?> Item(s)</h4>
  </td>
  <td class="quantity">
    <input class="cart_quantity_input" type="text" name="quantity" value="<?= $returnDetails["ProductCount"]; ?>"  size="2" readonly />
  </td>
  <td class="total">
    <h4><?= symValue($returnDetails["Total"]); ?></h4>
  </td>
  <td></td>
  <td></td>
</tr><!--/returnItemTotals_SHOP-->