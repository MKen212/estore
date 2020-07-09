<?php  // Display Registration Form
include("../app/views/admin/registerForm.php");

if (isset($_POST["register"])) {  // Register New User
  include_once("../app/models/userClass.php");
  
  $username = cleanInput($_POST["estUsername"], "string");
  $password = cleanInput($_POST["estPassword"], "password");
  $firstName = cleanInput($_POST["estFirstName"], "string");
  $lastName = cleanInput($_POST["estLastName"], "string");
  $email = cleanInput($_POST["estEmail"], "email");
  $contactNo = cleanInput($_POST["estContactNo"], "int");
  $_POST = [];

  $user = new User();
  $newUser = $user->register($username, $password, $firstName, $lastName, $email, $contactNo);
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
