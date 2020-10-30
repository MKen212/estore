<?php  // Admin Dashboard - Return Details
if (!isset($_GET["id"])) $_GET["id"] = "0";  // Set ReturnID to 0 if not provided
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
} elseif (isset($_GET["updReturnStatus"])) {  // Return Status Link was clicked
  $current = $_GET["cur"];
  // $_GET=[];
  $newStatus = statusCycle("ReturnStatus", $current);
  // Update ReturnStatus Status
  include_once "../app/models/returnsClass.php";
  $returns = new Returns();
  $returns->updateReturnStatus($returnID, $newStatus);
  // Fix Sidebar Returns Badge
  $toProcessCount = $returns->countRetStat(1);  // NOTE: HardCoded based on "Returned" status in Config/$statusCodes/ReturnStatus
  $toProcessBadge = ($toProcessCount > 0) ? " <span class='badge badge-warning'>To Process: $toProcessCount</span>" : "";
  ?><script>
    document.getElementById("toProcessBadge").innerHTML = "<?= $toProcessBadge ?>";
  </script><?php
} elseif (isset($_GET["updItemStatus"])) {  // Item Status Link was clicked
  $returnItemID = $_GET["itemID"];
  $current = $_GET["cur"];
  // $_GET=[];
  $newStatus = statusCycle("Status", $current);
  // Update ReturnItem Status
  include_once "../app/models/returnItemClass.php";
  $returnItem = new ReturnItem();
  $updateStatus = $returnItem->updateStatus($returnItemID, $newStatus);
} elseif (isset($_GET["updItemIsReceived"])) {  // Item Received Link was clicked
  $returnItemID = $_GET["itemID"];
  $current = $_GET["cur"];
  // $_GET=[];
  $newStatus = statusCycle("IsReceived", $current);
  // Update OrderItem IsReceived
  include_once "../app/models/returnItemClass.php";
  $returnItem = new ReturnItem();
  $updateStatus = $returnItem->updateIsReceived($returnItemID, $newStatus);
} elseif (isset($_GET["updItemIsActioned"])) {  // Item Actioned Link was clicked
  $returnItemID = $_GET["itemID"];
  $current = $_GET["cur"];
  // $_GET=[];
  $newStatus = statusCycle("IsActioned", $current);
  // Update OrderItem IsActioned
  include_once "../app/models/returnItemClass.php";
  $returnItem = new ReturnItem();
  $updateStatus = $returnItem->updateIsActioned($returnItemID, $newStatus);
} elseif (isset($_POST["updReceivedDate"])) {  // Item Received Date was updated
  $returnItemID = $_GET["itemID"];
  $newReceivedDate = $_POST["newReceivedDate"];
  $_POST=[];
  // Update OrderItem ReceivedDate
  include_once "../app/models/returnItemClass.php";
  $returnItem = new ReturnItem();
  $update = $returnItem->updateReceivedDate($returnItemID, $newReceivedDate);
} elseif (isset($_POST["updActionedDate"])) {  // Item Actioned Date was updated
  $returnItemID = $_GET["itemID"];
  $newActionedDate = $_POST["newActionedDate"];
  $_POST=[];
  // Update OrderItem ActionedDate
  include_once "../app/models/returnItemClass.php";
  $returnItem = new ReturnItem();
  $update = $returnItem->updateActiondDate($returnItemID, $newActionedDate);
} elseif (isset($_GET["refund"])) {  // Process Refund Link was clicked
  $invoiceID = $_GET["invId"];
  $noteToPayer = "Refund for Return {$invoiceID}-RTN-{$returnID}";
  $paymentID = $_GET["payId"];
  $value = $_GET["value"];
  // Process Refund
  include_once "../app/models/paypalClass.php";
  $paypal = new PayPal();
  $paypal->refundPayment($invoiceID, $noteToPayer, DEFAULTS["currency"], $value, $paymentID, $returnID);
}
?>
<!-- Main Section - Admin Returns Info -->
<div class="row pt-3 pb-2 mb-3 border-bottom">
  <div class="col-6">
    <h2>Return Details - ID: <?= $returnID ?></h2>
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

if ($returnDetails == false) :  // ReturnID not found ?>
  <div>Return ID not found.</div>
<?php else :
  // Generate ReturnsRef
  $returnDetails["ReturnsRef"] = $returnDetails["InvoiceID"] . "-RTN-" . $returnDetails["ReturnID"];

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
                <th style="border-left:double">Date Received<br />Date Actioned<br />Last Edit</th>
                <th>Received<br />Actioned<br />Status</th>
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