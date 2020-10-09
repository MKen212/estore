<?php  // Shop - Return Details

?>
<section id="cart_items"><!--return_details-->
  <div class="container">
    <div class="heading">
		  <h3>Return Details</h3>
    </div>

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
      <?php else:
        // Get Return Details
        $returnDetails = $returns->getDetails($returnID);



        // UP TO HERE - Show Return Details and ReturnItems


      endif;
      



    endif; ?>
  </div>
</section><!--/return_details-->