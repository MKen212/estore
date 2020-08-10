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
      "Items" => 0,
      "Products" => 0,
      "ShippingWeightKG" => 0,
      "ShippingBand" => "",
      "ShippingType" => "Standard",
      "SubTotal" => 0.00,
      "ShippingCost" => 0.00,
      "Total" => 0.00,
    ];
  }
  $newItemID = $_SESSION["cart"][0]["Items"] + 1;
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
  $_SESSION["cart"][0]["Items"] = $newItemID;
  $_SESSION["cart"][0]["Products"] += $qtyOrdered;
  $_SESSION["cart"][0]["ShippingWeightKG"] += ($weightGrams * $qtyOrdered) / 1000;
  $_SESSION["cart"][0]["SubTotal"] += ($price * $qtyOrdered);
  $_SESSION["cart"][0]["Total"] = $_SESSION["cart"][0]["SubTotal"];
  return true;
}

/**
 * msgPrep function - Used to add relevant DIV Classes to results message
 * @param string $type       Type of message (success / warning / danger)
 * @param string $msg        Message Content
 * @return string $prepdMsg  Prepared Message
 */
function msgPrep($type, $msg) {
  if ($type == "success") {
    $prepdMsg = '<div class="alert alert-success">' . $msg . '<div>';
  } else if ($type == "warning") {
    $prepdMsg = '<div class="alert alert-warning">' . $msg . '<div>';
  } else if ($type == "danger") {
    $prepdMsg = '<div class="alert alert-danger">' . $msg . '<div>';
  }
  return $prepdMsg;
}

/**
 * countryOptions function - Outputs all Countries as HTML options
 * @param string $defCode  Default Country Code marked as 'selected'
 * @return bool            Returns true on completion
 */
function countryOptions($defCode) {
  if ($defCode == null || $defCode == "") $defCode = DEFAULTS["countryCode"];  // Use Default if not set
  include_once "../app/models/countryClass.php";
  $country = new Country();
  foreach (new RecursiveArrayIterator($country->getCountries()) as $value) {
    if ($value["Code"] == $defCode) {
      echo "<option value='" . $value["Code"] . "' selected>" . $value["Name"] . "</option>";
    } else {
      echo "<option value='" . $value["Code"] . "'>" . $value["Name"] . "</option>";
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
 * lcValue function - Returns the the default currency + value to 2 decimal places
 * @param float $value  Value to be prefixed
 * @return string       Returns the Default currency + value
 */
function symValue($value) {
  return DEFAULTS["currency"] . " " . number_format($value, 2);
}
?>