<tr><!--return_item_SHOP-->
  <td class="cart_product" style="margin-right:-30px">
    <img width="90" height="83" src="<?= $record["FullPath"]; ?>" alt="<?= $record["ImgFilename"]; ?>" />
  </td>
  <td class="cart_description">
    <h4><?= $record["Name"]; ?></h4>
    <p>Product ID: <?= $record["ProductID"]; ?></p>
  </td>
  <td class="cart_price">
    <p><?= symValue($record["Price"]); ?></p>
  </td>
  <td class="cart_quantity">
    <input class="cart_quantity_input" type="text" name="quantity" value="<?= $record["QtyReturned"]; ?>" autocomplete="off" size="2" readonly />
  </td>
  <td class="cart_total">
    <p class="cart_total_price"><?= symValue(($record["QtyReturned"] * $record["Price"])); ?></p>
  </td>
  <td>
    <p><?= statusOutput("ReturnReason", $record["ReturnReason"]); ?></p><br />
    <p><?= statusOutput("ReturnAction", $record["ReturnAction"]); ?></p>
  </td>
  <td class="cart_shipped">
    <p><?= ($record["ReceivedDate"] == "0000-00-00") ? "- Pending -" : date("d/m/Y", strtotime($record["ReceivedDate"])); ?></p><br />
    <p><?= ($record["ActionedDate"] == "0000-00-00") ? "- Pending -" : date("d/m/Y", strtotime($record["ActionedDate"])); ?></p>
  </td>
</tr><!--/return_item_SHOP-->