<?php  // Shop - Order Confirmation

?>
<section id="cart_items"><!--order_confirmation-->
  <div class="container">
    <div class="heading">
		  <h3>Order Confirmation</h3>
    </div>
    
    <?php  // Check Cart has confirmed order
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
        // TODO Sort Warning
        $resultMsg = msgPrep("danger", $_SESSION["message"]);
      } else {
        // Build New Order Items Records
        $ordItmFields = "(";
        $ordItmValues = "(";
        foreach ($_SESSION["cart"] as $key => $value) {
          if ($key == 0) continue;  // Skip 0 record
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
          // TODO Sort Warning
          $resultMsg = msgPrep("danger", $_SESSION["message"]);
        } else {
          // Clear the Cart now that it is loaded in the database
          unset($_SESSION["cart"]);
          ?><script>
            document.getElementById("cartItems").innerHTML = "";
          </script><?php

        }
      }
    ?>





    <pre>
    <?php // Display Order Confirmation

    // UP TO HERE - NEED TO CREATE THE ORDER DETAILS VIEW

    echo "NEW ORDER CREATED: {$addOrder} <br />";
    echo "NEW ITEMS CREATED: {$addItems} <br />";



    print_r($_SESSION);
    ?>
    </pre>

    <?php endif; ?>

  </div>
</section>