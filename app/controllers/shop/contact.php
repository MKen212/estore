<?php  // Shop - Contact

?>
<div id="contact-page" class="container"><!--contact-page-->
  <div class="row">
    <div class="col-sm-12 bg">
      <h2 class="title text-center">Contact Us</h2>
    </div>
  </div>

  <div class="row">
    <?php
    // If User is Logged In, Get User contact details
    if (isset($_SESSION["userLogin"])) {
      $id = $_SESSION["userID"];
      include_once "../app/models/userClass.php";
      $user = new User();
      // Get User Details for selected record
      $contactData = $user->getRecord($id);
    } else {
      $contactData =  [
        "Name" => "",
        "Email" => "",
      ];
    }

    include "../app/views/shop/contactForm.php";

    if (isset($_POST["sendContact"])) {  // Send Message
      $name = cleanInput($_POST["contactName"], "string");
      $emailFrom = cleanInput($_POST["contactEmail"], "email");
      $subject = cleanInput($_POST["contactSubject"], "string");
      $body = cleanInput($_POST["contactBody"], "string");
      $_POST = [];

      // TO HERE - NEED TO ADD MESSAGES FUNCTIONALITY

      $_SESSION["message"] = msgPrep("danger", "Message not sent.");

      // Refresh page
      ?><script>
        window.location.assign("index.php?p=contact");
      </script><?php

    }

    include "../app/views/shop/contactDetails.php";
    ?>
  </div>
</div><!--/contact-page-->