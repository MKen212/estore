<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="decription" content="eStore Online Store" />
  <meta name="author" content="Malarena SA" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>eStore - User Logout</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/userForms.css" />
</head>

<body class="text-center">
  <!-- Logout Page -->
  <div class="container-fluid">
    <!-- Header -->
    <div class="row justify-content-center">
      <h1>eStore Online Store</h1>
    </div>
    <div class="row justify-content-center mb-3">
      <h2>Goodbye.</h2>
    </div>

    <!-- Logout Message & cleanup -->
    <div class="row justify-content-center mb-3">
      <h5>
        <?php  // Display Message & Clear the session
        if (isset($_SESSION["message"])) echo $_SESSION["message"];
        session_unset();
        session_destroy();
        ?>
      </h5>
    </div>

    <!-- Re-Login -->
    <div class="row justify-content-center">
      <a href="../views/user-login.php">Back to Login</a>
    </div>

    <div>
  </div>

</body>
</html>