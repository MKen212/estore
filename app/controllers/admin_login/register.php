<?php  // Admin - Register New User Form
include_once "../app/models/userClass.php";
$user = new User();

// Register New User if Regiser POSTed
if (isset($_POST["register"])) {
  $email = cleanInput($_POST["email"], "email");
  $password = cleanInput($_POST["password"], "password");
  $name = cleanInput($_POST["name"], "string");
  
  // Create database entry
  $newUserID = $user->register($email, $password, $name);
  unset($user, $password, $_POST["password"]);
  
  if ($newUserID) {  // Database Entry Success
    $_POST = [];
  }
}

// Initialise New User Record
$newUserRecord = [
  "Email" => postValue("email"),
  "Name" => postValue("name"),
];

// Show Register User Form
include "../app/views/admin_login/registerForm.php";
?>