<!--Shop - Home-->
<section id="slider"><!--slider--><!--
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div id="slider-carousel" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
            <li data-target="#slider-carousel" data-slide-to="1"></li>
            <li data-target="#slider-carousel" data-slide-to="2"></li>
          </ol>
          
          <div class="carousel-inner">
            <div class="item active">
              <div class="col-sm-6">
                <h1><span>E</span>-SHOPPER</h1>
                <h2>Free E-Commerce Template</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                <button type="button" class="btn btn-default get">Get it now</button>
              </div>
              <div class="col-sm-6">
                <img src="images/home/girl1.jpg" class="girl img-responsive" alt="" />
                <img src="images/home/pricing.png"  class="pricing" alt="" />
              </div>
            </div>
            <div class="item">
              <div class="col-sm-6">
                <h1><span>E</span>-SHOPPER</h1>
                <h2>100% Responsive Design</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                <button type="button" class="btn btn-default get">Get it now</button>
              </div>
              <div class="col-sm-6">
                <img src="images/home/girl2.jpg" class="girl img-responsive" alt="" />
                <img src="images/home/pricing.png"  class="pricing" alt="" />
              </div>
            </div>
            
            <div class="item">
              <div class="col-sm-6">
                <h1><span>E</span>-SHOPPER</h1>
                <h2>Free Ecommerce Template</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                <button type="button" class="btn btn-default get">Get it now</button>
              </div>
              <div class="col-sm-6">
                <img src="images/home/girl3.jpg" class="girl img-responsive" alt="" />
                <img src="images/home/pricing.png" class="pricing" alt="" />
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
  </div><-->
</section><!--/slider-->
<section>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h2>eStore Home</h2>
      </div>

      <?php // Display Welcome or Logged Out and/or latest system message
      if (isset($_SESSION["userLogin"])) echo "<h3>Welcome, {$_SESSION["userName"]}.</h3>";
      if (isset($_GET["q"])) echo "<h3>You are successfully logged out. Thanks for using eStore.</h3>";
      if (isset($_SESSION["message"])) {
        echo "<h5>Last System Message:</h5>";
        msgShow();
      }
      ?>

      <div>
        <pre>
          <?php
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
            echo "<br />";
          ?>
        </pre>
      </div><!--/Home-->
    </div>
  </div>
</section>