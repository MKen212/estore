<?php
session_start();
require "../app/helpers/helperFunctions.php";
require "../app/config/_config.php";

// Get Page Details
$page = "login";
if (isset($_GET["p"])) {
  $page = cleanInput($_GET["p"], "string");
}

// Check Valid Page is entered
$validPages = ["login", "logout", "register"];
if (!in_array($page, $validPages)) {
  $_SESSION["message"] = msgPrep("danger", "Error - Page Not Found.");
  $page = "logout";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="description" content="E-STORE Online Store - Admin Login" />
  <meta name="author" content="Malarena SA" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>E-Store | Admin Login</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/userForms.css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" />

  <link rel="shortcut icon" href="images/shared/favicon-96x96.png" />
</head>

<body class="text-center">
  <div class="container-fluid">
    <!-- Header -->
    <div class="row justify-content-center logo">
      <div>
        <img style="margin-right:10px" src="images/shared/logo.png" alt="" />
      </div>
      <div style="margin-top:7px;">
        <a href="admin_login.php"><span>E</span>-STORE</a>
      </div>
    </div>
    <div class="row justify-content-center">
      <h1>Administration</h1>
    </div>
    <?php include "../app/controllers/admin_login/{$page}.php";?>
  </div>
</body>
</html>