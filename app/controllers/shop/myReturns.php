<?php  // Shop - My Returns
include_once "../app/models/returnsClass.php";
$returns = new Returns();

// Get logged in userID
$userID = 0;
if (isset($_SESSION["userLogin"])) {
  $userID = $_SESSION["userID"];
}

// Get List of returns for Current User
$returnsList = $returns->getListByUser($userID, 1);

// Display Users Returns List View
include "../app/views/shop/myReturnsList.php";
?>