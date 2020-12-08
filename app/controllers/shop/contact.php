<?php  // Shop - Contact
include_once "../app/models/userClass.php";
$user = new User();
include_once "../app/models/messageClass.php";
$message = new Message();


// TO HERE - NEED TO WORK LIKE PRODUCT ADD - POST THEN PREP RECORD


// If User is Logged In, Get User contact details
$userID = 0;
$contactData =  [
  "Email" => "",
  "Name" => "",
];
if (isset($_SESSION["userLogin"])) {
  $userID = $_SESSION["userID"];  
  // Get User Details for selected record
  $contactData = $user->getRecord($userID);
}

// Add Message Record if Contact Form POSTed
if (isset($_POST["sendContact"])) {
  $senderName = cleanInput($_POST["contactName"], "string");
  $senderEmail = cleanInput($_POST["contactEmail"], "email");
  $subject = cleanInput($_POST["contactSubject"], "string");
  $body = cleanInput($_POST["contactBody"], "string");

  // Add message to Database
  $newMessageID = $message->add($senderName, $senderEmail, $subject, $body, $userID);
}
$_POST = [];


?>
<div id="contact-page" class="container"><!--contact-page-->
  <div class="row">
    <div class="col-sm-12 bg">
      <h2 class="title text-center">Contact Us</h2>
    </div>
  </div>

  <div class="row"><?php
    

    include "../app/views/shop/contactForm.php";

    

    include "../app/views/shop/contactDetails.php";
    ?>
  </div>
</div><!--/contact-page-->