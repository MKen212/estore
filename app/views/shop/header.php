<!-- Shop Header -->
<header id="header">
  <div class="header_top"><!--header_top-->
    <div class="container">
      <div class="row">
        <div class="col-sm-6 ">
          <div class="contactinfo">
            <ul class="nav nav-pills">
              <li><a href=""><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
              <li><a href=""><i class="fa fa-envelope"></i> info@domain.com</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="social-icons pull-right">
            <ul class="nav navbar-nav">
              <li><a href=""><i class="fa fa-facebook"></i></a></li>
              <li><a href=""><i class="fa fa-twitter"></i></a></li>
              <li><a href=""><i class="fa fa-linkedin"></i></a></li>
              <li><a href=""><i class="fa fa-dribbble"></i></a></li>
              <li><a href=""><i class="fa fa-google-plus"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div><!--/header_top-->
  
  <div class="header-middle"><!--header-middle-->
    <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <div class="logo pull-left">
            <a href="/"><img src="images/home/logoName.png" alt="" /></a>
          </div>
          <div class="btn-group pull-right">
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                USA
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                <li><a href="">Canada</a></li>
                <li><a href="">UK</a></li>
              </ul>
            </div>
            
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                DOLLAR
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                <li><a href="">Canadian Dollar</a></li>
                <li><a href="">Pound</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-8">
          <div class="shop-menu pull-right">
            <ul class="nav navbar-nav">
              <li><a href="admin_dashboard.php?p=home"><i class="fa fa-user"></i> Account</a></li>
              <li><a href=""><i class="fa fa-star"></i> Wishlist</a></li>
              <li><a <?= $_GET["p"] == "checkout" ? 'class="active"' : null;?>href="index.php?p=checkout"><i class="fa fa-crosshairs"></i> Checkout</a></li>
              <li><a <?= $_GET["p"] == "cart" ? 'class="active"' : null;?>href="index.php?p=cart"><i class="fa fa-shopping-cart"></i> Cart <span class="badge cart-badge" id="cartItems"><?= isset($_SESSION["cart"][0]) && !isset($_GET["mt"]) ? $_SESSION["cart"][0]["itemCount"] : null; ?></span></a></li>
              <li><a href="admin.php"><i class="fa fa-lock"></i> Login</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div><!--/header-middle-->

  <div class="header-bottom"><!--header-bottom-->
    <div class="container">
      <div class="row">
        <div class="col-sm-9">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="mainmenu pull-left">
            <ul class="nav navbar-nav collapse navbar-collapse">
              <li><a <?= $_GET["p"] == "home" ? 'class="active"' : null;?>href="/">Home</a></li>
              <li class="dropdown"><a <?= $_GET["p"] == "products" || $_GET["p"] == "productDetails" ? 'class="active"' : null;?>href="#">Shop<i class="fa fa-angle-down"></i></a>
                <ul role="menu" class="sub-menu">
                  <li><a <?= $_GET["p"] == "products" ? 'class="active"' : null;?>href="index.php?p=products&sp=1">Products</a></li>
                  <li><a <?= $_GET["p"] == "productDetails" ? 'class="active"' : null;?>href="index.php?p=productDetails&id=1">Product Details</a></li> 
                  <li><a <?= $_GET["p"] == "checkout" ? 'class="active"' : null;?>href="index.php?p=checkout">Checkout</a></li> 
                  <li><a <?= $_GET["p"] == "cart" ? 'class="active"' : null;?>href="index.php?p=cart">Cart</a></li> 
                  <li><a href="login.html">Login</a></li> 
                </ul>
              </li> 
              <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                <ul role="menu" class="sub-menu">
                  <li><a <?= $_GET["p"] == "orderDisplay" ? 'class="active"' : null;?>href="index.php?p=orderDisplay">Display Order</a></li>
                  <li><a href="blog.html">Blog List</a></li>
                  <li><a href="blog-single.html">Blog Single</a></li>
                </ul>
              </li> 
              <li><a href="404.html">404</a></li>
              <li><a href="contact-us.html">Contact</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="search_box pull-right">
            <input type="text" placeholder="Search"/>
          </div>
        </div>
      </div>
    </div>
  </div><!--/header-bottom-->  
</header>