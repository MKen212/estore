<?php  // Admin Dashboard - User Details
if (!isset($_GET["id"])) $_GET["id"] = "0";  // Set UserID to 0 if not provided
?>
<!-- Main Section - User Details -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>User Details - User ID: <?= $_GET["id"] ?></h2>
</div>

<?php
$id = cleanInput($_GET["id"], "int");
include_once "../app/models/userClass.php";
$user = new User();

// Get User Details for selected record
$userData = $user->getRecord($id);

if ($userData == false) {  // UserID not found
  echo "<div>User ID not found.</div>";
} else {
  // Show User Form
  $formData = [
    "subName" => "updateUser",
    "subText" => "Update User",
  ];
  include "../app/views/admin/userForm.php";

  if (isset($_POST["updateUser"])) {  // Update User Record
    $email = cleanInput($_POST["email"], "email");
    $password = cleanInput($_POST["password"], "password");
    $name = cleanInput($_POST["name"], "string");
    $isAdmin = $_POST["isAdmin"];
    $status = $_POST["status"];
    $_POST = [];

    if ($email == $userData["Email"]) $email = "";  // Unset $email if same as DB

    include_once "../app/models/userClass.php";
    $user = new User();
    $updateUser = $user->updateRecord($id, $email, $password, $name, $isAdmin, $status);
    unset($user, $password);

    // Refresh page
    ?><script>
      window.location.assign("admin_dashboard.php?p=userDetails&id=<?= $id ?>");
    </script><?php
  }
}
