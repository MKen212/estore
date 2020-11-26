<?php  // Admin Dashboard - Users List/Edit
include_once "../app/models/userClass.php";
$user = new User();

// Get recordID if provided and process Status changes if hyperlinks clicked
$userID = 0;
if (isset($_GET["id"])) {
  $userID = cleanInput($_GET["id"], "int");

  if (isset($_GET["updStatus"])) {  // Status link was clicked
    $curStatus = cleanInput($_GET["cur"], "int");
    $newStatus = statusCycle("Status", $curStatus);
    // Update User Status
    $updateStatus = $user->updateStatus($userID, $newStatus);
    
  } elseif (isset($_GET["updIsAdmin"])) {  // IsAdmin link was clicked
    $curStatus = cleanInput($_GET["cur"], "int");
    $newStatus = statusCycle("IsAdmin", $curStatus);
    // Update User IsAdmin
    $updateStatus = $user->updateIsAdmin($userID, $newStatus);
  }
}
$_GET = [];

// Fix User Email Search if entered
$email = null;
if (isset($_POST["userSearch"])){
  $email = fixSearch($_POST["schEmail"]);
}
$_POST = [];

// Get List of users
$userList = $user->getList($email);

// Display Users List View
include "../app/views/admin/usersList.php";
?>