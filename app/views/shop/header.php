<!-- Shop Header -->
<header id="header">
  <div class="header_top"><!--header_top-->
    <div class="container">
      <div class="row">
        <div class="col-sm-6 ">
          <div class="contactinfo">
            <ul class="nav nav-pills">
              <li><a href=""><i class="fa fa-phone"></i> +41 21 123 4567</a></li>
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
            <a href="/"><img src="images/shared/logoName.png" alt="" /></a>
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
              <?php if (isset($_SESSION["userLogin"])) : 
                if ($_SESSION["userIsAdmin"] == 1) : ?>
                  <li><a href="admin_dashboard.php?p=home"><i class="fa fa-tasks"></i> Admin</a></li>
                <?php endif; ?>
                <li><a href="index.php?p=myAccount"><i class="fa fa-user"></i> My Account</a></li>
              <?php endif; ?>
              <li><a href=""><i class="fa fa-star"></i> Wishlist</a></li>
              <li><a <?= $_GET["p"] == "checkout" ? 'class="active"' : null;?>href="index.php?p=checkout"><i class="fa fa-crosshairs"></i> Checkout</a></li>
              <li><a <?= $_GET["p"] == "cart" ? 'class="active"' : null;?>href="index.php?p=cart"><i class="fa fa-shopping-cart"></i> Cart <span class="badge cart-badge" id="cartItems"><?= isset($_SESSION["cart"][0]) && !isset($_GET["mt"]) ? $_SESSION["cart"][0]["itemCount"] : null; ?></span></a></li>
              <?php if (isset($_SESSION["userLogin"])) : ?>
                <li><a <?= $_GET["p"] == "logout" ? 'class="active"' : null;?>href="index.php?p=logout"><i class="fa fa-unlock-alt"></i> Logout</a></li>
              <?php else : ?>
                <li><a <?= $_GET["p"] == "login" ? 'class="active"' : null;?>href="index.php?p=login"><i class="fa fa-lock"></i> Login</a></li>
              <?php endif; ?>
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
              <li class="dropdown"><a <?= $_GET["p"] == "login" || $_GET["p"] == "myAccount"|| $_GET["p"] == "myOrders" ? 'class="active"' : null;?>href="#">Account<i class="fa fa-angle-down"></i></a>
                <ul role="menu" class="sub-menu">
                  <?php if (isset($_SESSION["userLogin"])) : ?>
                    <li><a <?= $_GET["p"] == "myAccount" ? 'class="active"' : null;?>href="index.php?p=myAccount">My Account</a></li>
                    <li><a <?= $_GET["p"] == "myOrders" ? 'class="active"' : null;?>href="index.php?p=myOrders">My Orders</a></li>
                    <li><a href="index.php?p=logout">Logout</a></li>
                  <?php else : ?>
                    <li><a <?= $_GET["p"] == "login" ? 'class="active"' : null;?>href="index.php?p=login">Login</a></li>
                  <?php endif; ?>
                </ul>
              </li>
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