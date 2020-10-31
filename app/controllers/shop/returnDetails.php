<?php  // Shop - Return Details

?>
<section id="cart_items"><!--return_details-->
  <div class="container">
    <div class="row">
      <div class="col-sm-12 bg">
        <h2 class="title text-center">Return Details</h2>
      </div>
    </div>

    <div class="row">
      <?php
      msgShow();  // Show any system messages coming from orderConfirmation

      if (!isset($_GET["id"])) :  // Check ReturnID Provided ?>
        <div class="register-req">
          <p>No Return ID provided.</p>
        </div>
      <?php else :
        $returnID = $_GET["id"];
        $_GET = [];
        include_once "../app/models/returnsClass.php";
        $returns = new Returns();

        $refData = $returns->getRefData($returnID);
        if ($_SESSION["userID"] != $refData["OwnerUserID"]) :  // Check Return is owned by current user ?>
          <div class="register-req">
            <p>Sorry - You do not have access to Return ID `<?= $returnID ?>` for Invoice ID '<?= $refData["InvoiceID"] ?>'.</p>
          </div>
        <?php elseif ($refData["Status"] == 0) :  // Check Return is not Inactive?>
          <div class="register-req">
            <p>Sorry - Return ID `<?= $returnID ?>` for Invoice ID '<?= $refData["InvoiceID"] ?>' is marked as 'Inactive'.</p>
          </div>
        <?php else:
          // Get Return Details
          $returnDetails = $returns->getDetails($returnID);
          $returnDetails["ReturnsRef"] = $returnDetails["InvoiceID"] . "-RTN-" . $returnDetails["ReturnID"];  // Returns Ref Field

          // Show Details in Returns Header
          include "../app/views/shop/returnsHeader.php";

          // Show Return Items
          ?>
          <div class="row" style="margin-bottom:50px"><!--return_items-->
            <div class="col-sm-12 shopper-info">
              <h5>Returned Items</h5>
              <div class="table-responsive cart_info">
                <table class="table table-condensed" style="margin-bottom:0px">
                  <thead>
                    <tr class="cart_menu">
                      <td class="image">Item</td>
                      <td class="description"></td>
                      <td class="price">Unit Price</td>
                      <td class="quantity">Quantity</td>
                      <td class="total">Item Total</td>
                      <td>Reason<br/>Action</td>
                      <td>Date Received<br/>Date Actioned</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include_once "../app/models/returnItemClass.php";
                    $returnItem = new ReturnItem();
                    // Loop through Return Items and output a row per item
                    foreach (new RecursiveArrayIterator($returnItem->getItemsByReturn($returnID, 1)) as $record) {
                      $record["FullPath"] = getFilePath($record["ProductID"], $record["ImgFilename"]);

                      include "../app/views/shop/returnItem.php";
                    }

                    // Show Return Item Totals
                    include "../app/views/shop/returnItemTotals.php";
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div><!--/return_items-->
        <?php endif;
      endif; ?>
    </div>
  </div>
</section><!--/return_details-->