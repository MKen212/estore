<?php  // Shop - My Account

?>
<section id="cart_items"><!--my_account-->
  <div class="container">
    <div class="heading">
		  <h3>My Account</h3>
    </div>

    <?php  // Check User is Logged In
    if (!isset($_SESSION["userLogin"])) : ?>
      <div class="register-req">
        <p>Please <a href="index.php?p=login&r=checkout">Login (or Signup)</a> to proceed.</p>
      </div>
    <?php else :
      $id = $_SESSION["userID"];
      include_once "../app/models/userClass.php";
      $user = new User();
      // Get User Details for selected record
      $userData = $user->getRecord($id);

      include "../app/views/shop/userForm.php";
      
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
    endif; ?>
  </div>
</section>
