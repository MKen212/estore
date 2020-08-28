<?php  // Admin - Register New User Form
include "../app/views/admin/registerForm.php";

if (isset($_POST["register"])) {  // Register New User
  include_once "../app/models/userClass.php";
  $email = cleanInput($_POST["email"], "email");
  $password = cleanInput($_POST["password"], "password");
  $name = cleanInput($_POST["name"], "string");
  $_POST = [];

  $user = new User();
  $newUser = $user->register($email, $password, $name);
  unset($user, $password);

  if ($newUser) {
    // Registration Success
    $resultMsg = msgPrep("success", $_SESSION["message"]);
  } else {
    // Registration Failure
    $resultMsg = msgPrep("danger", $_SESSION["message"]);
  }
  ?><script>
    document.getElementById("registerFormResult").innerHTML = `<?= $resultMsg;?>`;
  </script><?php
  unset($_SESSION["message"]);
}
?>