<?php  // Admin Dashboard - User Add
include_once "../app/models/userClass.php";
$user = new User();

// Add User Record if Add POSTed
if (isset($_POST["addUser"])) {
  $email = cleanInput($_POST["email"], "email");
  $password = cleanInput($_POST["password"], "password");
  $name = cleanInput($_POST["name"], "string");
  $isAdmin = cleanInput($_POST["isAdmin"], "int");
  $status = cleanInput($_POST["status"], "int");

  // Create database entry
  $newUserID = $user->register($email, $password, $name, $isAdmin, $status);
  unset($password);

  if ($newUserID) {  //  Database Entry Success
    $_POST = [];
  }
}

// Initialise User Record
$userRecord = [
  "Email" => postValue("email"),
  "Name" => postValue("name"),
  "IsAdmin" => postValue("isAdmin", 0),
  "Status" => postValue("status", 1),
];

// Prep User Form Data
$formData = [
  "formUsage" => "Add",
  "formTitle" => "Add User",
  "subName" => "addUser",
  "subText" => "Add User",
];

// Show User Form
include "../app/views/admin/userForm.php";
?>