<?php  // Shop - My Account
include_once "../app/models/userClass.php";
$user = new User();

$userID = $_SESSION["userID"];

// Update User Record if Update POSTed
if (isset($_POST["updateUser"])) {  // Update User
  $email = cleanInput($_POST["email"], "email");
  $password = cleanInput($_POST["password"], "password");
  $name = cleanInput($_POST["name"], "string");
  $isAdmin = $userData["IsAdmin"];
  $status =  $userData["Status"];
  $_POST = [];

  if ($email == $userData["Email"]) $email = "";  // Unset $email if same as current record

  $updateUser = $user->updateRecord($id, $email, $password, $name, $isAdmin, $status);
  unset($password);

  // Refresh page
  ?><script>
    window.location.assign("index.php?p=myAccount");
  </script><?php
}


?>
<section id="cart_items"><!--my_account-->
  <div class="container">
    <div class="row">
      <div class="col-sm-12 bg">
        <h2 class="title text-center">My Account</h2>
      </div>
    </div>

    <div class="row"><?php
      // Check User is Logged In
      if (!isset($_SESSION["userLogin"])) : ?>
        <div class="register-req">
          <p>Please <a href="index.php?p=login&r=checkout">Login (or Signup)</a> to proceed.</p>
        </div><?php
      else :
        
        
        // Get User Details for selected record
        $userData = $user->getRecord($id);

        include "../app/views/shop/userForm.php";
        
        
      endif; ?>
    </div>
  </div>
</section><!--/my_account-->
