<?php  // Admin Dashboard - Messages List/Edit
include_once "../app/models/messageClass.php";
$message = new Message();

// Fix Message Email/Subject Search if entered
$search = null;
if (isset($_POST["messageSearch"])){
  $search = fixSearch($_POST["schEmailorSubj"]);
}
$_POST = [];

// Get List of messages
$messageList = $message->getList($search);

// Display Messages List View
include "../app/views/admin/messagesList.php";
?>