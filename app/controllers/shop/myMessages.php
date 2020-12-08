<?php  // Shop - My Messages
include_once "../app/models/messageClass.php";
$message = new Message();

// Get logged in userID
$userID = 0;
if (isset($_SESSION["userLogin"])) {
  $userID = $_SESSION["userID"];
}

// Get List of ACTIVE messages for Current User
$messageList = $message->getListByUser($userID, 1);

// Display Users Messages List View
include "../app/views/shop/myMessagesList.php";
?>