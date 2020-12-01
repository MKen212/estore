<!-- Home - SHOP -->
<section>
  <div class="container">
    <div class="row"><?php
      // Display Logged Out message, if logged out
      if (isset($_GET["q"])) {
        msgShow();
      }
      // Display latest system message, if set
      if (isset($_SESSION["message"])) {
        echo "<h5>Last System Message:</h5>";
        msgShow();
      }
      // Display Testing Information if in Testing Mode
      if (DEFAULTS["testing"] == true) : ?>
        <div>
          <pre><?php
            echo "SESSION: ";
            print_r($_SESSION);
            echo "<br />POST: ";
            print_r($_POST);
            echo "<br />GET: ";
            print_r($_GET);
            echo "<br />FILES: ";
            print_r($_FILES);
            // echo "<br />SERVER: ";
            // print_r($_SERVER);
            // echo "<br />"; ?>
          </pre>
        </div><?php
      endif;?>
    </div>
  </div>
</section>

<!--slider_carousel-->
<section id="slider">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div id="slider-carousel" class="carousel slide" data-ride="carousel" data-interval="10000">
          <ol class="carousel-indicators">
            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
            <li data-target="#slider-carousel" data-slide-to="1"></li>
            <li data-target="#slider-carousel" data-slide-to="2"></li>
          </ol>
          
          <div class="carousel-inner">
            <div class="item active">
              <div class="col-sm-6">
                <h1><span>E</span>-STORE</h1>
                <h2>Interactive Web Store</h2>
                <p>Fully interactive Web Store that provides an easy-to-use interface for shoppers to search and view products, add items to their shopping cart, place orders and manage any returns.</p>
                <a class="btn btn-default get" href="index.php?p=products">Start Shopping now</a>
              </div>
              <div class="col-sm-6">
                <img src="images/shop/home1.jpg" class="homeAd img-responsive" alt="" />
              </div>
            </div>
            <div class="item">
              <div class="col-sm-6">
                <h1><span>E</span>-STORE</h1>
                <h2>Integrated with PayPal</h2>
                <p>All orders can be paid for using PayPal. Even if the shopper does not have a PayPal account there are options to pay using a Debit or Credit Card.</p>
                <a class="btn btn-default get" href="index.php?p=products">Start Shopping now</a>
              </div>
              <div class="col-sm-6">
                <img src="images/shop/home2.jpg" class="homeAd img-responsive" alt="" />
              </div>
            </div>
            <div class="item">
              <div class="col-sm-6">
                <h1><span>E</span>-STORE</h1>
                <h2>Separate Secure Admin Tool</h2>
                <p>Administration of the products, orders, returns, messages and users, as well as the general system configuration is available via a separate secure administration tool.</p>
                <a class="btn btn-default get" href="index.php?p=products">Start Shopping now</a>
              </div>
              <div class="col-sm-6">
                <img src="images/shop/home3.jpg" class="homeAd img-responsive" alt="" />
              </div>
            </div>
          </div>
          
          <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
            <i class="fa fa-angle-left"></i>
          </a>
          <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
            <i class="fa fa-angle-right"></i>
          </a>
        </div>
        
      </div>
    </div>
  </div>
</section><!--/slider_carousel-->