<?php
session_start();
require "../app/config/_config.php";
require "../app/helpers/helperFunctions.php";
require "../vendor/autoload.php";

if (!isset($_GET["p"])) $_GET["p"] = "home";  // If $_GET not set, page=home
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="decription" content="Electronic Online Store" />
  <meta name="author" content="Malarena SA" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>eStore | Shop</title>

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

<body>
  <?php include "../app/views/shop/header.php";

  if($_GET["p"] == "home" || $_GET["p"] == "products" || $_GET["p"] == "productDetails") : ?>
    <section>
      <div class="container">
        <div class="row">
          <div class="col-sm-3">
            <?php include "../app/views/shop/sidebar.php";?>
          </div>
          <div class="col-sm-9 padding-right">
            <?php include "../app/controllers/shop/" . $_GET["p"] . ".php"; ?>
          </div>
        </div>
      </div>
    </section>
  <?php else:
    include "../app/controllers/shop/" . $_GET["p"] . ".php";
  endif;

  include "../app/views/shop/footer.php";?>
  
  <script src="js/jquery.js"></script>
  <script src="js/price-range.js"></script>
  <script src="js/jquery.scrollUp.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.prettyPhoto.js"></script>
  <script src="js/main.js"></script>
  <script src="js/estore.js"></script>

</body>
</html>