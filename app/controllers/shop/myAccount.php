<?php  // Shop - My Account
include_once "../app/models/userClass.php";
$user = new User();

// Get logged in userID
$userID = 0;
if (isset($_SESSION["userLogin"])) {
  $userID = $_SESSION["userID"];
}

// Update User Record if Update POSTed
if (isset($_POST["updateUser"])) {
  $email = cleanInput($_POST["email"], "email");
  $password = cleanInput($_POST["password"], "password");
  $name = cleanInput($_POST["name"], "string");
  $isAdmin = $_SESSION["userIsAdmin"];
  $status =  ($_SESSION["userLogin"] == 1) ? 1 : 0;  // If logged in must be active

  // Update database entry
  $updateUser = $user->updateRecord($userID, $email, $password, $name, $isAdmin, $status);
  unset($password);
}
$_POST = [];

// Get User Details for selected record
$userRecord = $user->getRecord($userID);

// Show User Form
include "../app/views/shop/userForm.php";
?>