<?php  // Shop - Contact
include_once "../app/models/userClass.php";
$user = new User();
include_once "../app/models/messageClass.php";
$message = new Message();

// Get logged in userID
$userID = 0;
if (isset($_SESSION["userLogin"])) {
  $userID = $_SESSION["userID"];
}

// Add Message Record if Contact Form POSTed
if (isset($_POST["sendContact"])) {
  $senderName = cleanInput($_POST["contactName"], "string");
  $senderEmail = cleanInput($_POST["contactEmail"], "email");
  $subject = cleanInput($_POST["contactSubject"], "string");
  $body = cleanInput($_POST["contactBody"], "string");

  // Add message to Database
  $newMessageID = $message->add($senderName, $senderEmail, $subject, $body, $userID);

  if ($newMessageID) {  // Database Entry success
    $_POST = [];
  }
}

// Initialise Message Record
$contactRecord = [
  "Name" => postValue("contactName"),
  "Email" => postValue("contactEmail"),
  "Subject" => postValue("contactSubject"),
  "Body" => postValue("contactBody"),
];

// If Contact Form is not yet POSTed and user is logged in, update User contact details
if (!isset($_POST["sendContact"]) && !empty($userID)) {
  $userRecord = $user->getRecord($userID);
  $contactRecord["Name"] = $userRecord["Name"];
  $contactRecord["Email"] = $userRecord["Email"];
}

// Show Contact Form
include "../app/views/shop/contactForm.php";
?>