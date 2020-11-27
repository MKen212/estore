<!-- Admin Dashboard - User Add -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Add User</h2>
</div><?php

// Initialise User Data
$userData = [
  "Email" => null,
  "Name" => null,
  "IsAdmin" => 0,
  "Status" => 1,
];

// Show User Form
$formData = [
  "subName" => "addUser",
  "subText" => "Add User",
];
include "../app/views/admin/userForm.php";

if (isset($_POST["addUser"])) {  // Add User Record
  // Clean Fields for DB entry
  $email = cleanInput($_POST["email"], "email");
  $password = cleanInput($_POST["password"], "password");
  $name = cleanInput($_POST["name"], "string");
  $isAdmin = $_POST["isAdmin"];
  $status = $_POST["status"];
  $_POST = [];

  // Create database entry
  include_once "../app/models/userClass.php";
  $user = new User();
  $newUserID = $user->register($email, $password, $name, $isAdmin, $status);
  unset($password);

  // Refresh page
  ?><script>
    window.location.assign("admin_dashboard.php?p=userAdd");
  </script><?php
}
?>