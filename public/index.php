<?php
session_start();
include_once("../app/config/_config.php");
if (!isset($_GET["p"])) $_GET["p"] = "home";  // If $_GET not set, page=home
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="decription" content="Electronic Online Store" />
  <meta name="author" content="Malarena SA" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>eStore | Shop</title>

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/prettyPhoto.css">
  <link rel="stylesheet" href="css/price-range.css">
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/responsive.css">
  
  <link rel="shortcut icon" href="images/home/favicon-96x96.png">
</head><!--/head-->

<body>
  <?php include("../app/views/shop/header.php");

  if($_GET["p"] == "cart" || $_GET["p"] == "checkout") : 
    include("../app/controllers/shop/" . $_GET["p"] . ".php");
  else : 
  ?>
	<section>
		<div class="container">
			<div class="row">
        <div class="col-sm-3">
          <?php include("../app/views/shop/sidebar.php");?>
        </div>

				<div class="col-sm-9 padding-right">
          <?php include("../app/controllers/shop/" . $_GET["p"] . ".php"); ?>
        </div>
        
			</div>
		</div>
	</section>
  
  <?php
  endif;
  include("../app/views/shop/footer.php");?>
  
  <script src="js/jquery.js"></script>
  <script src="js/price-range.js"></script>
  <script src="js/jquery.scrollUp.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.prettyPhoto.js"></script>
  <script src="js/main.js"></script>

</body>
</html>