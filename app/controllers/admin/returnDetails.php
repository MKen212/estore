<?php  // Admin Dashboard - Return Details
if (!isset($_GET["id"])) :  // Check Return ID Provided ?>
  <div>No Return ID provided.</div>
<?php else : 
  $returnID = $_GET["id"];
  // Process Status Changes if hyperlinks selected
  if (isset($_GET["updStatus"])) {  // Record Status Link was clicked
    $current = $_GET["cur"];
    // $_GET=[];
    $newStatus = statusCycle("Status", $current);
    // Update Returns Status
    include_once "../app/models/returnsClass.php";
    $returns = new Returns();
    $updateStatus = $returns->updateStatus($returnID, $newStatus);
  }

  ?>
<!-- Main Section - Admin Order Info -->
  <div class="row pt-3 pb-2 mb-3 border-bottom">
    <div class="col-6">
      <h2>Return Details - Return ID: <?= $returnID ?></h2>
    </div>
    <div class="col-6">
      <!-- System Messages -->
      <?php msgShow(); ?>
    </div>
  </div>

  <?php
  $_GET = [];
  include_once "../app/models/returnsClass.php";
  $returns = new Returns();

  // Get Returns Details
  $returnDetails = $returns->getDetails($returnID);
  $returnDetails["ReturnsRef"] = $returnDetails["InvoiceID"] . "-RTN-" . $returnDetails["ReturnID"];  // Returns Ref Field

  // Show Details in Returns Header
  include "../app/views/admin/returnsHeader.php";

  // Show Returns Items
  ?>
  <div class="row"><!--return_items-->
    <div class="col-sm-12">
      <h5>Returned Items</h5>
        <div class="table-responsive">
          <table class="table table-striped table-sm" style="margin-bottom:50px">
            <thead>
              <tr>
                <th>Item</th>
                <th>Image</th>
                <th>Product Details</th>
                <th>Unit Price</th>
                <th>Qty</th>
                <th>Reason<br />Action</th>
                <th style="border-left:double">Date/Time Received<br />Date/Time Actioned</th>
                <th>Received<br />Actioned</th>
                <th style="border-left:double">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include_once "../app/models/returnItemClass.php";
              $returnItem = new ReturnItem();
              // Loop through Return Items and output a row per item
              $itemCount = 0;
              foreach (new RecursiveArrayIterator($returnItem->getItemsByReturn($returnID)) as $record) {
                $itemCount +=1;
                $record["FullPath"] = getFilePath($record["ProductID"], $record["ImgFilename"]);

                include "../app/views/admin/returnItem.php";
              }
              ?>
            </tbody>
          </table>
        </div>
    </div>
  </div><!--/return_items-->
<?php endif; ?>