<?php
session_start();
include_once("../config/_config.php");
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
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
  <?php include("shop-header.php");?>
	
	<section>
		<div class="container">
			<div class="row">
        <div class="col-sm-3">
          <?php include("shop-sidebar.php");?>
        </div>

				<div class="col-sm-9 padding-right">
          <?php include("shop-products.php");?>
        </div>
        
			</div>
		</div>
	</section>
  
  <?php include("shop-footer.php");?>
  
  <script src="js/jquery.js"></script>
  <script src="js/price-range.js"></script>
  <script src="js/jquery.scrollUp.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.prettyPhoto.js"></script>
  <script src="js/main.js"></script>

</body>
</html>