<?php
session_start();
require "../app/helpers/helperFunctions.php";
require "../app/config/_config.php";
require "../vendor/autoload.php";

if (!isset($_GET["p"])) $_GET["p"] = "home";  // If page not set, use "home"
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="description" content="E-STORE Online Store" />
  <meta name="author" content="Malarena SA" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>E-Store | Shop</title>

  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" />
  <link rel="stylesheet" href="css/prettyPhoto.css" />
  <link rel="stylesheet" href="css/price-range.css" />
  <link rel="stylesheet" href="css/animate.css" />
  <link rel="stylesheet" href="css/main.css" />
  <link rel="stylesheet" href="css/responsive.css" />
  
  <link rel="shortcut icon" href="images/shared/favicon-96x96.png" />

  <script src="https://www.paypal.com/sdk/js?client-id=<?= PAYPALAPI["clientID"] ?>&currency=<?= DEFAULTS["currency"] ?>"></script>
</head><!--/head-->

<body><?php
  
  include "../app/controllers/shop/header.php";

  include "../app/controllers/shop/" . $_GET["p"] . ".php";

  include "../app/views/shop/footer.php";?>
  
  <script src="js/jquery.js"></script>
  <!-- <script src="js/price-range.js"></script> -->
  <!-- <script src="js/jquery.scrollUp.min.js"></script> -->
  <script src="js/bootstrap.min.js"></script>
  <!-- <script src="js/jquery.prettyPhoto.js"></script> -->
  <!-- <script src="js/main.js"></script> -->
  <!-- <script src="js/estore.js"></script> -->

</body>
</html>