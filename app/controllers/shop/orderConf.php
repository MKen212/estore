<?php  // Shop - Order Confirmation

// UP TO HERE - ADDED ORDER RECORD . NEED TO TIMESTAMP AND THEN ADD ITEMS AND OUTPUT RESULT IN AN ORDER INFO FORM OR SIMILAR. ALSO NEED TO RECORD PAYMENT SOMEWHERE...
          

          // // Build new Order Record
          // $insFields = "";
          // $insValues = "";
          // if ($_SESSION["userLogin"]) {
          //   $insFields .= "`UserID`, ";
          //   $insValues .= "'" . $_SESSION["userID"] . "', ";
          // }
          // foreach ($_SESSION["cart"][0] as $key => $value) {
          //   if ($key == "shopperInfo") {
          //     $insFields .= "`" . implode("`, `", array_keys($_SESSION["cart"][0]["shopperInfo"])) . "`";
          //     $insValues .= "'" . implode("', '", $_SESSION["cart"][0]["shopperInfo"]) . "'";
          //   } else {
          //     $insFields .= "`" . $key . "`, ";
          //     $insValues .= "'" . $value . "', ";
          //   }
          // }
          // //  Insert new Order Record into orders table
          // include_once("../app/models/orderClass.php");
          // $order = new Order;
          // $addOrder = $order->add($insFields, $insValues);
          // if ($addOrder) {  // Database Entry Success
          //   $resultMsg = msgPrep("success", $_SESSION["message"]);
          // } else {  // Database Entry Failed
          //   $resultMsg = msgPrep("danger", $_SESSION["message"]);
          // }


          
          
          // Insert Order Items into order_items table
          // echo "Inserting Order Items into order_items table </br>";

?>

<section><!--order_confirmation-->
  <div class="container">
    <div class="heading">
		  <h3>Order Confirmation</h3>
		</div>
    
    <?php  // Display Order
      include("../app/views/shop/orderDetails.php");
    ?>

  </div>
</section><!--/order_confirmation-->
