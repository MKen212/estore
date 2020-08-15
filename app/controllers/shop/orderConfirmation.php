<?php  // Shop - Order Confirmation

?>
<section id="cart_items"><!--order_confirmation-->
  <div class="container">
    <div class="heading">
		  <h3>Order Confirmation</h3>
    </div>
    
    <?php  // Check Cart contains a confirmed order
    /* TODO REMOVE BLOCK COMMENT
    if (!isset($_SESSION["cart"][0]["ppOrderID"])) :?>
      <div style="margin-bottom:50px">Your Order is not yet confirmed.</div>
    <?php else : 
      // Build New Order Record
      $ordFields = "(";
      $ordValues = "(";
      foreach ($_SESSION["cart"][0] as $key => $value) {
        if ($key == "ppOrderStatus") {
          $ordFields .= "`Status`)";
          if ($value == "COMPLETED") {
            $ordValues .= "'1')";
          } else {
            $ordValues .= "'0')";
          }
        } else {
          $ordFields .= "`" . ucfirst($key) . "`, ";
          $ordValues .= "'" . $value . "', ";
        }
      }
      
      // Save Order to Database
      include_once "../app/models/orderClass.php";
      $order = new Order;
      $addOrder = $order->add($ordFields, $ordValues);
      if (!$addOrder) {  // Database Entry Failed
        $resultMsg = msgPrep("danger", $_SESSION["message"]);
        echo $resultMsg;
      } else {
        // Build New Order Items Records
        $ordItmFields = "(";
        $ordItmValues = "(";
        foreach ($_SESSION["cart"] as $key => $value) {
          if ($key == 0) continue;  // Skip record 0
          if ($key == 1) {  // Build Field List only on 1st Item
            // First Field is OrderID
            $ordItmFields .= "`OrderID`, ";
            $ordItmValues .= "'" . $addOrder . "', ";
            // Rest of Fields from cart item array
            foreach ($value as $itmKey => $itmVal) {
              if ($itmKey == "timestamp") {
                $ordItmFields .= "`AddedTimestamp`)";
                $ordItmValues .= "'" . $itmVal . "')";
              } else {
                $ordItmFields .= "`" . ucfirst($itmKey) . "`, ";
                $ordItmValues .= "'" . $itmVal . "', ";
              }
            }
          } else {  // Build Values only on remaining items
            // First Field is OrderID
            $ordItmValues .= ", ('" . $addOrder . "', ";
            // Rest of Fields from cart item array
            foreach ($value as $itmKey => $itmVal) {
              if ($itmKey == "timestamp") {
                $ordItmValues .= "'" . $itmVal . "')";
              } else {
                $ordItmValues .= "'" . $itmVal . "', ";
              }
            }
          }
        }
        // Save Order Items to Database
        $addItems = $order->addItems($ordItmFields, $ordItmValues);
        if (!$addItems) {  // Database Entry Failed
          $resultMsg = msgPrep("danger", $_SESSION["message"]);
          echo $resultMsg;
        } else {
          $_SESSION["invoiceID"] = $_SESSION["cart"][0]["invoiceID"];
          // Clear the Cart now that it is loaded in the database
          unset($_SESSION["cart"]);?>
          <script>
            document.getElementById("cartItems").innerHTML = "";
          </script>
          <div>Your order was processed successfully. The details are as follows:</div><?php

          include "../app/controllers/shop/orderDetails.php";
        }
      } 
    endif; */?>
    <div class="register-req">Your order was processed successfully. The details are as follows:</div><?php
    $_SESSION["invoiceID"] = "14005";
    include "../app/controllers/shop/orderDetails.php";?>
  </div>
</section>
