<!-- My Returns List - SHOP -->
<section id="cart_items"><!--my_returns-->
  <div class="container">
    <div class="row">
      <div class="col-sm-12 bg">
        <h2 class="title text-center">My Returns</h2>
      </div>
    </div>

    <div class="row"><?php
      if (!isset($_SESSION["userLogin"])) :  // Check User is Logged In ?>
        <div class="register-req">
          <p>Please <a href="index.php?p=login">Login (or Signup)</a> to proceed.</p>
        </div><?php
      else :  // Display Returns List ?>
        <!-- Returns List - SHOP -->
        <div class="table-responsive" style="margin-bottom:75px">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>Returns Ref</th>
                <th>Invoice ID</th>
                <th>Items</th>
                <th>Products</th>
                <th>Date/Time Added</th>
                <th>Refund Value</th>
                <th>Returns Status</th>
              </tr>
            </thead>
            <tbody><?php
              if (empty($returnsList)) :  // No Returns Records Found ?>
                <tr>
                  <td colspan ='7'>No Returns to Display</td>
                </tr><?php
              else : 
                foreach ($returnsList as $record) : ?>
                  <tr><!-- Returns Record -->
                    <td><a href="index.php?p=returnDetails&id=<?= $record["ReturnID"] ?>"><?= returnRef($record["InvoiceID"], $record["ReturnID"]) ?></a></td>
                    <td><?= $record["InvoiceID"] ?></td>
                    <td><?= $record["ItemCount"] ?></td>
                    <td><?= $record["ProductCount"] ?></td>
                    <td><?= date("d/m/Y @ H:i", strtotime($record["AddedTimestamp"])) ?></td>
                    <td><?= symValue($record["RefundTotal"]) ?></td>
                    <td><?= statusOutputShop("ReturnStatus", $record["ReturnStatus"]) ?></td>
                  </tr><?php
                endforeach;
              endif; ?>      
            </tbody>
          </table>
        </div><?php
      endif; ?>
    </div>
  </div>
</section>