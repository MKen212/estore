<tr><!--returns_available_item-->
  <td><?= $itemCount; ?></td>
  <td>
    <img width="90" height="83" src="<?= $record["FullPath"] ?>" alt="<?= $record["ImgFilename"]; ?>" />
  </td>
  <td><b><?= $record["Name"]; ?></b><br />Product ID: <?= $record["ProductID"]; ?></td>
  <td><?= symValue($record["Price"]); ?></td>
  <td ><?= date("d/m/Y", strtotime($record["ShippedDate"])); ?></td>
  
  <td style="border-left:double">
    <input type="checkbox" name="returns[<?= $itemCount ?>][orderItemID]" value="<?= $record["OrderItemID"]; ?>" />
    <input type="hidden" name="returns[<?= $itemCount ?>][price]" value="<?= $record["Price"] ?>" />
  </td>
  <td>
    <input type="number" name="returns[<?= $itemCount ?>][qtyReturned]" value="<?= $record["QtyAvailForRtn"]; ?>" min="1" max="<?= $record["QtyAvailForRtn"]; ?>" />
  </td>
  <td>
    <select name="returns[<?= $itemCount ?>][returnReason]"><?php
      statusOptions("ReturnReason", 0); ?>
    </select>
  </td>
  <td>
    <select name="returns[<?= $itemCount ?>][returnAction]"><?php
      statusOptions("ReturnAction", 0); ?>
    </select>
  </td>
</tr><!--/returns_available_item-->