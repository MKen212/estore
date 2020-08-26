<?php  // Shop - Order Display
// TODO Probably REMOVE this page, or at least protect so it only shows for logged in user

?>
<section id="cart_items"><!--order_details-->
  <div class="container">
    <div class="heading">
		  <h3>Order Details</h3>
    </div>

    <?php  // If InvoiceID not provided show search
    if (!isset($_POST["invoiceID"])) :?>
      <div>
        <form action="index.php?p=orderDisplay" method="POST" name="schInvoiceID">
          <input style="width: 150px; margin-bottom: 50px" type="text" name="invoiceID" placeholder="Enter Invoice ID" autocomplete="off" />
          <button class="btn btn-secondary" type="submit" name="invIDSearch"><i class="fa fa-search"></i></button>
        </form>
      </div>
    <?php else : 
      $_SESSION["invoiceID"] = $_POST["invoiceID"];

      // Show the order details
      include "../app/controllers/shop/orderDetails.php";

      // Clear the InvoiceID Session Variable
      unset($_SESSION["invoiceID"]);
    
    endif; ?>
  </div>
</section>