<tr><!--order_list_item-->
  <td><a href="admin_dashboard.php?p=orderDetails&id=<?= $record["InvoiceID"]; ?>"><?= $record["InvoiceID"]; ?></a></td>
  <td><?= $record["ItemCount"]; ?></td>
  <td><?= $record["ProductCount"]; ?></td>
  <td><?= $record["ShippingCountry"]; ?></td>
  <td><?= $record["ShippingType"]; ?></td>
  <td><?= $record["Total"]; ?></td>
  <td><?= $record["PaymentStatus"]; ?></td>
  <td><?= $record["PayerName"]; ?></td>
  <td><?= date("d/m/Y @ H:i", strtotime($record["EditTimestamp"])); ?></td>
  <td><?= ordStatusText($record["Status"]); ?></td>
</tr><!--/order_list_item-->
