<?php  // Global Helper Functions

/**
 * cleanInput function - Used to clean all Form data entered
 * @param string $input   Original Input
 * @param string $type    Input Type (string, int, float, email, password)
 * @return string $input  Cleaned Input
 */
function cleanInput($input, $type) {
  // Clean all with htmlspecialchars
  $input = htmlspecialchars($input);
  if ($type == "string") {
    $input = trim($input);
    $input = stripslashes($input);
    $input = filter_var($input, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_LOW);
  } else if ($type == "int") {
    $input = filter_var($input, FILTER_SANITIZE_NUMBER_INT);
  } else if ($type == "float") {
    $input = filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
  } else if ($type = "email") {
    $input = filter_var($input, FILTER_SANITIZE_EMAIL);
  }
  return $input;
}

/**
 * pagination function - Used to display page links
 * @param int $subPage   Current Sub Page being viewed
 * @param int $lastPage  Last Page for all records
 * @param string $url    URL used in hyperlink href
 */
function pagination($subPage, $lastPage, $url) {
  $midPage = ceil(DEFAULTS["paginationItems"] / 2);
  if ($subPage <= $midPage  || $lastPage <= DEFAULTS["paginationItems"]) {  // First Section
    $leftScroll = 0;
    $firstItem = 1;
    if ($lastPage > DEFAULTS["paginationItems"]) {
      $lastItem = DEFAULTS["paginationItems"];
      $rightScroll = $lastItem + 1;
    } else {
      $lastItem = $lastPage;
      $rightScroll = 0;
    }
  } else if ($subPage > ($lastPage - $midPage)) {  // Last Section
    $leftScroll = $lastPage - DEFAULTS["paginationItems"];
    $firstItem = $leftScroll + 1;
    $lastItem = $lastPage;
    $rightScroll = 0;
  } else {  // Middle - Remainder
    $leftScroll = $subPage - $midPage;
    $firstItem = $leftScroll + 1;
    $rightScroll = $subPage + $midPage;
    $lastItem = $rightScroll - 1;
  }  
  
  if ($leftScroll) echo '<li><a href="'. $url . $leftScroll . '">&laquo</a></li>';
  for ($counter = $firstItem; $counter <= $lastItem; $counter++) {
    $class = $counter==$subPage ? ' class="active"' : null;
    echo '<li' . $class . '><a href="' . $url . $counter . '">' . $counter . '</a></li>';
  }
  if ($rightScroll) echo '<li><a href="' . $url . $rightScroll . '">&raquo</a></li>';
  
  return true;
}

/**
 * addToCart function - Used to add items to the Cart
 * @param int $productID       ProductID of item ordered
 * @param string $name         Product Name
 * @param float $price         Product Price
 * @param int $weightGrams     Shipping Weight of item ordered
 * @param int $qtyOrdered      Quantity of item ordered
 * @param string $imgFilename  Filename for Product Image
 * @return bool                Returns true on completion
 */
function addToCart($productID, $name, $price, $weightGrams, $qtyOrdered, $ImgFilename) {
  if (!isset($_SESSION["cart"][0])) {  // Create Empty Session Cart if not already created
    $_SESSION["cart"][0] = [
      "itemCount" => 0,
      "productCount" => 0,
      "shippingInstructions" => "",
      "shippingWeightKG" => 0,
      "shippingPriceBandKG" => 0,
      "shippingCountry" => DEFAULTS["countryCode"],
      "shippingType" => "Standard",
      "subTotal" => 0.00,
      "shippingCost" => 0.00,
      "total" => 0.00,
      "invoiceID" => "",
      "ppOrderID" => "",
      "ppOrderStatus" => "",
    ];
  }
  // Add Item
  $newItemID = $_SESSION["cart"][0]["itemCount"] + 1;
  $newItem = [
    "itemID" => $newItemID,
    "productID" => $productID,
    "name" => $name,
    "price" => $price,
    "weightGrams" => $weightGrams,
    "qtyOrdered" => $qtyOrdered,
    "imgFilename" => $ImgFilename,
    "timestamp" => date("Y-m-d H:i:s"),
  ];
  $_SESSION["cart"][$newItemID] = $newItem;
    
  // Update Weights, Counts & Totals
  $_SESSION["cart"][0]["itemCount"] += 1;
  $_SESSION["cart"][0]["productCount"] += $qtyOrdered;
  $_SESSION["cart"][0]["shippingWeightKG"] += ($weightGrams * $qtyOrdered) / 1000;
  $_SESSION["cart"][0]["subTotal"] += ($price * $qtyOrdered);
  $_SESSION["cart"][0]["total"] = $_SESSION["cart"][0]["subTotal"];
  return true;
}

/**
 * removeFromCart function - Used to remove an item for the Cart
 * @param int $itemID  ItemID of item to be removed
 * @return bool        Returns true on completion
 */
function removeFromCart($itemID) {
  if ($_SESSION["cart"][0]["itemCount"] == 1) {  // Only 1 item in cart so delete cart
    unset($_SESSION["cart"]);
  } else {  // Remove Specific Item Details from Totals
    $_SESSION["cart"][0]["itemCount"] -= 1;
    $_SESSION["cart"][0]["productCount"] -= $_SESSION["cart"][$itemID]["qtyOrdered"];
    $_SESSION["cart"][0]["shippingWeightKG"] -= ($_SESSION["cart"][$itemID]["weightGrams"] * $_SESSION["cart"][$itemID]["qtyOrdered"]) / 1000;
    $_SESSION["cart"][0]["shippingPriceBandKG"] = 0;
    $_SESSION["cart"][0]["subTotal"] -= ($_SESSION["cart"][$itemID]["price"] * $_SESSION["cart"][$itemID]["qtyOrdered"]);
    $_SESSION["cart"][0]["shippingCost"] = 0.00;
    $_SESSION["cart"][0]["total"] = $_SESSION["cart"][0]["subTotal"];
    // Remove Specific Item
    unset($_SESSION["cart"][$itemID]);
    // Re-Build Cart
    $newCart = [];
    $newKey = 0;
    foreach($_SESSION["cart"] as $value) {
      $newCart[$newKey] = $value;
      if ($newKey != 0) $newCart[$newKey]["itemID"] = $newKey;  // Fix Item ID
      $newKey++;
    }
    // Reload Cart to Session
    unset($_SESSION["cart"]);
    $_SESSION["cart"] = $newCart;
    return true;
  }
}

/**
 * msgPrep function - Used to add relevant DIV Classes to results message
 * @param string $type       Type of message (success / warning / danger)
 * @param string $msg        Message Content
 * @return string $prepdMsg  Prepared Message
 */
function msgPrep($type, $msg) {
  if ($type == "success") {
    $prepdMsg = '<div class="alert alert-success">' . $msg . '</div>';
  } else if ($type == "warning") {
    $prepdMsg = '<div class="alert alert-warning">' . $msg . '</div>';
  } else if ($type == "danger") {
    $prepdMsg = '<div class="alert alert-danger">' . $msg . '</div>';
  }
  return $prepdMsg;
}

/**
 * countryOptions function - Outputs all Countries as HTML options
 * @param string $selCode  Country Code that is marked as 'selected'
 * @return bool            Returns true on completion
 */
function countryOptions($selCode) {
  if (empty($selCode)) $selCode = DEFAULTS["countryCode"];  // Use Default if not set
  include_once "../app/models/countryClass.php";
  $country = new Country();
  foreach (new RecursiveArrayIterator($country->getCountries()) as $value) {
    if ($value["Code"] == $selCode) {
      echo "<option value='" . $value["Code"] . "' selected>" . $value["Name"] . "</option>";
    } else {
      echo "<option value='" . $value["Code"] . "'>" . $value["Name"] . "</option>";
    }
  }
  return true;
}

/**
 * shippingOptions function - Outputs distinct values from shipping field as HTML options
 * @param string $field   Field to get distinct values from
 * @param string $selOpt  Value that is marked as 'selected'
 * @return bool           Returns true on completion
 */
function shippingOptions($field, $selCode) {
  include_once "../app/models/shippingClass.php";
  $shipping = new Shipping;
  foreach (new RecursiveArrayIterator($shipping->getDistinct($field)) as $value) {
   if ($value[$field] == $selCode) {
     echo "<option value='" . $value[$field] . "' selected>" . $value[$field] . "</option>";
   } else {
     echo "<option value='" . $value[$field] . "'>" . $value[$field] . "</option>";
   }
  }
  return true;
}

/**
 * postValue function - Returns the value in a $_POST key field IF it's set
 * @param string $key            Name of $_POST["key"] to return
 * @return string $_POST["key"]  Returns $_POST key value or NULL
 */
function postValue($key) {
  if (isset($_POST["$key"])) {
    return $_POST["$key"];
  } else {
    return null;
  }
}

/**
 * symValue function - Returns the the default currency + value to 2 decimal places
 * @param float $value  Value to be prefixed
 * @return string       Returns the Default currency + value
 */
function symValue($value) {
  return DEFAULTS["currency"] . " " . number_format($value, 2);
}

/**
 * commaToBR function - Returns the string with the commas replaced with HTML <br /> tags
 * @param string $string  String to be changed
 * @return string         Retuns the updated string
 */
function commaToBR($string) {
  return str_replace(", ", "<br />", $string);
}

/**
 * ordStatusText function - Returns the Text relevant to the given status code
 * @param int $status          Order Status Code
 * @return string $statusText  Returns the Text for the Status Code
 */
function ordStatusText($status) {
  $statusText = "";
  if ($status == 0) {
    $statusText = "Placed";
  } else if ($status == 1) {
    $statusText = "Paid";
  } else if ($status == 2) {
    $statusText = "Shipped";
  } else if ($status == 3) {
    $statusText = "Returned";
  } else if ($status == 4) {
    $statusText = "Refunded";
  }
  return $statusText;
}

?>