<tr><!--order_item_SHOP-->
  <td class="cart_product">
    <img width="100" height="93" src="<?= $fullPath; ?>" alt="<?= $record["ImgFilename"]; ?>" />
  </td>
  <td class="cart_description">
    <h4><?= $record["Name"]; ?></h4>
    <p>Product ID: <?= $record["ProductID"]; ?></p>
  </td>
  <td class="cart_price">
    <p><?= symValue($record["Price"]); ?></p>
  </td>
  <td class="cart_quantity">
    <input class="cart_quantity_input" type="text" name="quantity" value="<?= $record["QtyOrdered"]; ?>" autocomplete="off" size="2" readonly />
  </td>
  <td class="cart_total">
    <p class="cart_total_price"><?= symValue(($record["QtyOrdered"] * $record["Price"])); ?></p>
  </td>
  <td class="cart_shipped">
    <p><?= $record["ShippedTimestamp"] == "0000-00-00 00:00:00" ? "- Pending -" : date("d/m/Y", strtotime($record["ShippedTimestamp"])); ?></p>
  </td>
  <td class="cart_status">
    <p><?= statusOutput("IsShipped", $record["IsShipped"]); ?></p>
  </td>
</tr><!--/order_item_SHOP-->