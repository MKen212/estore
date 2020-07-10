<?php  // Display Registration Form
include("../app/views/admin/registerForm.php");

if (isset($_POST["register"])) {  // Register New User
  include_once("../app/models/userClass.php");
  
  $username = cleanInput($_POST["username"], "string");
  $password = cleanInput($_POST["password"], "password");
  $fullName = cleanInput($_POST["fullName"], "string");
  $address1 = cleanInput($_POST["address1"], "string");
  $address2 = cleanInput($_POST["address2"], "string");
  $city = cleanInput($_POST["city"], "string");
  $region = cleanInput($_POST["region"], "string");
  $countryCode = cleanInput($_POST["countryCode"], "string");
  $postcode = cleanInput($_POST["postcode"], "string");
  $email = cleanInput($_POST["email"], "email");
  $contactNo = cleanInput($_POST["contactNo"], "int");
  $_POST = [];

  $user = new User();
  $newUser = $user->register($username, $password, $fullName, $address1, $address2, $city, $region, $countryCode, $postcode, $email, $contactNo);
  unset($user, $password);

  if ($newUser) {
    // Registration Success
    $resultMsg = msgPrep("success", $_SESSION["message"]);
  } else {
    // Registration Failure
    $resultMsg = msgPrep("danger", $_SESSION["message"]);
  }
  ?><script>
    document.getElementById("adminRegRes").innerHTML = `<?= $resultMsg;?>`;
  </script><?php
  unset($_SESSION["message"]);
}
?>
