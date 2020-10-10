<tr><!--order_list_item-->
  <td><a href="index.php?p=orderDetails&id=<?= $record["OrderID"]; ?>"><?= $record["InvoiceID"]; ?></a></td>
  <td><?= $record["ItemCount"]; ?></td>
  <td><?= $record["ProductCount"]; ?></td>
  <td><?= date("d/m/Y @ H:i", strtotime($record["AddedTimestamp"])); ?></td>
  <td><?= $record["Total"]; ?></td>
  <td><?= $record["PaymentStatus"]; ?></td>
  <td><?= statusOutputShop("OrderStatus", $record["OrderStatus"]); ?></td>
</tr><!--/order_list_item-->
