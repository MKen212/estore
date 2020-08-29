<?php
session_start();
require "../app/config/_config.php";
require "../app/helpers/helperFunctions.php";
if (!isset($_GET["p"])) $_GET["p"] = "login";  // If $_GET not set, page=login
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="decription" content="eStore Online Store" />
  <meta name="author" content="Malarena SA" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>eStore | Admin Login</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/userForms.css" />

  <link rel="shortcut icon" href="images/home/favicon-96x96.png" />
</head>

<body class="text-center">
  <div class="container-fluid">
    <!-- Header -->
    <div class="row justify-content-center">
      <a href="/"><img src="images/home/logoName.png" alt="" /></a>
    </div>
    <div class="row justify-content-center">
      <h1>eStore Administration</h1>
    </div>
    <?php include "../app/controllers/admin/" . $_GET["p"] . ".php";?>
  </div>

</body>
</html>