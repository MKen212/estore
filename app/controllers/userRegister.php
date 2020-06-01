<?php  // Register New User
include_once("../models/userClass.php");

if (isset($_POST["register"])) {
  $username = cleanInput($_POST["estUsername"], "string");
  $password = cleanInput($_POST["estPassword"], "password");
  $firstName = cleanInput($_POST["estFirstName"], "string");
  $lastName = cleanInput($_POST["estLastName"], "string");
  $email = cleanInput($_POST["estEmail"], "email");
  $contactNo = cleanInput($_POST["estContactNo"], "int");
  $_POST = [];

  $user = new User();
  $newUser = $user->registerUser($username, $password, $firstName, $lastName, $email, $contactNo);
  unset($user, $password);
  if ($newUser) {
    // Send Admin message
    // include_once("../models/messageClass.php");
    // $message = new Message();
    // $notify = $message->addMessage($newUser, DEFAULTS["userAdminUserID"], "New User", "Please process my New User registration.");
    // ECHO "They will receive an email once their account is approved." .
    // Registration Success
    echo "<div class='alert alert-success form-user'>" .
      $_SESSION["message"] . "</div>";
  } else {
    // Registration Failure
    echo "<div class='alert alert-danger form-user'>" .
      $_SESSION["message"] . "</div>";
  }
}
?>
