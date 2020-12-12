<?php  // Shop - Login / Register
include_once "../app/models/userClass.php";
$user = new User();

// Check if return page after login is set
if (isset($_GET["r"])) {
  $returnPage = cleanInput($_GET["r"], "string");
} else {
  $returnPage = "home";
}
$_GET = [];

// Verify & Login User if Login Form POSTed
if (isset($_POST["login"])) {
  $email = cleanInput($_POST["estEmail"], "string");
  $password = cleanInput($_POST["estPassword"], "password");
  $_POST = [];

  // Check database against user entry  
  $login = $user->login($email, $password);
  unset($user, $password);
  if ($login == true) {
    // Login Success - Redirect to return page
    ?><script>
      window.location.assign("index.php?p=<?= $returnPage ?>");
    </script><?php
  }
} elseif (isset($_POST["register"])) {
  // Register New User if Register Form Posted
  $email = cleanInput($_POST["email"], "email");
  $password = cleanInput($_POST["password"], "password");
  $name = cleanInput($_POST["name"], "string");

  // Create Database Entry
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

// Show Login/Register Form
include "../app/views/shop/loginRegForm.php";
?>