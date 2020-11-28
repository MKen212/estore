<?php  // Admin Dashboard - User Details
include_once "../app/models/userClass.php";
$user = new User();

// Get recordID if provided
$userID = 0;
if (isset($_GET["id"])) {
  $userID = cleanInput($_GET["id"], "int");
}
$_GET = [];

// Update User Record if Update POSTed
if (isset($_POST["updateUser"])) {
  $email = cleanInput($_POST["email"], "email");
  $password = cleanInput($_POST["password"], "password");
  $name = cleanInput($_POST["name"], "string");
  $isAdmin = cleanInput($_POST["isAdmin"], "int");
  $status = cleanInput($_POST["status"], "int");
  
  // Update database entry
  $updateUser = $user->updateRecord($userID, $email, $password, $name, $isAdmin, $status);
  unset($password);
}
$_POST = [];

// Get User Details for selected record
$userRecord = $user->getRecord($userID);

// Prep User Form Data
$formData = [
  "formUsage" => "Update",
  "formTitle" => "User Details - ID: " . $userID,
  "subName" => "updateUser",
  "subText" => "Update User",
];

// Show User Form
include "../app/views/admin/userForm.php";
?>