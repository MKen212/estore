<!-- Order Item - SHOP -->
<tr>
  <td class="cart_product">
    <img width="90" height="83" src="<?= getFilePath($record["ProductID"], $record["ImgFilename"]) ?>" alt="<?= $record["ImgFilename"] ?>" />
  </td>
  <td class="cart_description">
    <h4><?= $record["Name"] ?></h4>
    <p>Product ID: <?= $record["ProductID"] ?></p>
  </td>
  <td class="cart_price">
    <p><?= symValue($record["Price"]) ?></p>
  </td>
  <td class="cart_quantity">
    <input class="cart_quantity_input" type="text" name="quantity" value="<?= $record["QtyOrdered"] ?>" autocomplete="off" size="2" readonly />
  </td>
  <td class="cart_total">
    <p class="cart_total_price"><?= symValue(($record["QtyOrdered"] * $record["Price"])) ?></p>
  </td>
  <td class="cart_shipped">
    <p><?= ($record["ShippedDate"] == "0000-00-00") ? "- Pending -" : date("d/m/Y", strtotime($record["ShippedDate"])) ?></p>
  </td>
  <td>
    <p><?= ($record["ReturnAvailable"] == true) ? "<a class='btn btn-primary' style='margin-top:0px' href='index.php?p=returnItems&id=" . $orderID . "'>Available</a>" : "<i>Unavailable</i>"; ?></p>
  </td>
</tr>