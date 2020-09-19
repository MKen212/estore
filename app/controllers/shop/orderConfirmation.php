<?php  // Shop - Order Confirmation
// Check Cart contains a confirmed order
if (empty($_SESSION["cart"]) || empty($_SESSION["cart"][0]["ppOrderID"])) {
  $_SESSION["message"] = msgPrep("danger", "Error - Unable to process order as your Cart is empty or your Order is not yet confirmed.<br />");
  // Revert to Home Screen ?><script>
    window.location.assign("index.php?p=home");
  </script><?php
} else {
  // Build New Order Record
  $ordFields = "(";
  $ordValues = "(";
  foreach ($_SESSION["cart"][0] as $key => $value) {
    if ($key == "ppOrderID") {
      continue;  // ppOrderID not required in orders table
    } elseif ($key == "ppOrderStatus") {  // Last field in Cart
      $ordFields .= "`OwnerUserID`, `EditUserID`, `OrderStatus`)";
      $ordValues .= "'" . $_SESSION["userID"] . "', '" . $_SESSION["userID"] . "', ";
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
  $order = new Order();
  $addOrder = $order->add($ordFields, $ordValues);

  if (!$addOrder) {  // Database Add Order Failed
    return;  // Stop further processing
  } else {
    // Build New Order Items Records
    $ordItmFields = "(";
    $ordItmValues = "(";
    $prodQtyUpdates = [];  // Product Quantity Updates Array
    foreach ($_SESSION["cart"] as $key => $value) {
      if ($key == 0) continue;  // Skip record 0
      // Fill Product Quantity Updates Array
      if (array_key_exists($value["productID"], $prodQtyUpdates)) {
        $prodQtyUpdates[$value["productID"]] += -$value["qtyOrdered"];
      } else {
        $prodQtyUpdates[$value["productID"]] = -$value["qtyOrdered"];
      }          
      if ($key == 1) {  // Build Field List only on 1st Item
        // First Field is OrderID
        $ordItmFields .= "`OrderID`, ";
        $ordItmValues .= "'" . $addOrder . "', ";
        // Rest of Fields from cart item array
        foreach ($value as $itmKey => $itmVal) {
          if ($itmKey == "timestamp") {  // Last field in Cart Item
            $ordItmFields .= "`AddedToCartTimestamp`, `EditUserID`)";
            $ordItmValues .= "'" . $itmVal . "', '" . $_SESSION["userID"] . "')";
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
          if ($itmKey == "timestamp") {  // Last field in Cart Item
            $ordItmValues .= "'" . $itmVal . "', '" . $_SESSION["userID"] . "')";
          } else {
            $ordItmValues .= "'" . $itmVal . "', ";
          }
        }
      }
    }
    // Save Order Items to Database
    $addItems = $order->addItems($ordItmFields, $ordItmValues);

    if (!$addItems) {  // Database Add Items Success
      return;  // Stop further processing
    } else{
      // Update Products Quantity Available for each item
      include_once "../app/models/productClass.php";
      $product = new Product();
      foreach($prodQtyUpdates as $productID => $qtyAvailChg) {
        $prodUpdate = $product->updateQtyAvail($productID, $qtyAvailChg);
        if (!$prodUpdate) {  // Database Product Update Failed
          return;  // Stop further processing
        }
      }
      // Clear the Cart & Header now that it is loaded in the database
      unset($_SESSION["cart"]);
      ?><script>
        document.getElementById("cartItems").innerHTML = "";
      </script><?php
      
      $_SESSION["message"] = msgPrep("success", ("THANK YOU, " . $_SESSION["userName"] . "! Your order was processed successfully. The details are as follows:<br />"));

      // Show the order details
      $_GET["id"] = $addOrder;
      include "../app/controllers/shop/orderDetails.php";
    }
  } 
}
?>