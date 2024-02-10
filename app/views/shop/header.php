<!-- Header - SHOP -->
<header id="header">
  <div class="header_top"><!--header_top-->
    <div class="container">
      <div class="row">
        <div class="col-sm-6 ">
          <!-- Phone / Email -->
          <div class="contactinfo">
            <ul class="nav nav-pills">
              <li><a href="tel:<?= DEFAULTS["contactPhone"] ?>"><i class="fa fa-phone"></i> <?= DEFAULTS["contactPhone"] ?></a></li>
              <li><a href="mailto:<?= DEFAULTS["contactEmail"];?>"><i class="fa fa-envelope"></i> <?= DEFAULTS["contactEmail"] ?></a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-6">
          <!-- Social Media Icons -->
          <div class="social-icons pull-right">
            <ul class="nav navbar-nav">
              <li><a href=""><i class="fa fa-facebook"></i></a></li>
              <li><a href=""><i class="fa fa-twitter"></i></a></li>
              <li><a href=""><i class="fa fa-youtube"></i></a></li>
              <li><a href=""><i class="fa fa-linkedin"></i></a></li>
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
        <div class="col-sm-3">
          <!-- Logo -->
          <div class="logo pull-left">
            <img src="images/shared/logo.png" alt="" /><a href="index.php"> <span>e</span>-store</a>
          </div>
        </div>
        <div class="col-sm-3">
          <!-- Shop Welcome Message -->
          <div class="shop-welcome"><?= isset($_SESSION["userLogin"]) ? "Welcome, " . $_SESSION["userName"] : "" ?></div>
        </div>
        <div class="col-sm-6">
          <!-- Shop Top-Right Quick Menu -->
          <div class="shop-menu pull-right">
            <ul class="nav navbar-nav"><?php
              if (isset($_SESSION["userLogin"])) : 
                if ($_SESSION["userIsAdmin"] == 1) : ?>
                  <!-- Admin -->
                  <li><a href="admin_dashboard.php?p=home"><i class="fa fa-tasks"></i> Admin</a></li><?php
                endif; ?>
                <!-- My Account -->
                <li><a href="index.php?p=myAccount"><i class="fa fa-user"></i> My Account</a></li><?php
              endif; ?>
              <!-- Checkout -->
              <li><a <?= ($page == "checkout") ? 'class="active"' : null ?>href="index.php?p=checkout"><i class="fa fa-crosshairs"></i> Checkout</a></li>
              <!-- Cart -->
              <li><a <?= ($page == "cart") ? 'class="active"' : null ?>href="index.php?p=cart"><i class="fa fa-shopping-cart"></i> Cart <span class="badge cart-badge" id="cartItems"><?= isset($_SESSION["cart"][0]) && !isset($_GET["mt"]) ? $_SESSION["cart"][0]["itemCount"] : null ?></span></a></li>
              <!-- Login/Logout --><?php
              if (isset($_SESSION["userLogin"])) : ?>
                <li><a <?= ($page == "logout") ? 'class="active"' : null ?>href="index.php?p=logout"><i class="fa fa-unlock-alt"></i> Logout</a></li><?php
                else : ?>
                <li><a <?= ($page == "login") ? 'class="active"' : null ?>href="index.php?p=login"><i class="fa fa-lock"></i> Login</a></li><?php
              endif; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div><!--/header-middle-->

  <div class="header-bottom"><!--header-bottom-->
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <!-- Shop Top-Left Navbar -->
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
              <!-- Home -->
              <li><a <?= ($page == "home") ? 'class="active"' : null ?>href="index.php">Home</a></li>
              <!-- Shop Dropdown -->
              <li class="dropdown"><a <?= (($page == "products") || ($page == "productDetails") || ($page == "checkout") || ($page == "cart")) ? 'class="active"' : null ?>href="#">Shop<i class="fa fa-angle-down"></i></a>
                <ul role="menu" class="sub-menu">
                  <!-- Products -->
                  <li><a <?= (($page == "products") || ($page == "productDetails")) ? 'class="active"' : null ?>href="index.php?p=products&sp=1">Products</a></li>
                  <!-- Cart -->
                  <li><a <?= ($page == "cart") ? 'class="active"' : null ?>href="index.php?p=cart">Cart</a></li>
                  <!-- Checkout -->
                  <li><a <?= ($page == "checkout") ? 'class="active"' : null ?>href="index.php?p=checkout">Checkout</a></li>
                </ul>
              </li>
              <!-- Account Dropdown -->
              <li class="dropdown"><a <?= (($page == "login") || ($page == "myAccount") || ($page == "myOrders") || ($page == "orderDetails") || ($page == "myReturns") || ($page == "returnDetails") || ($page == "returnItems") || ($page == "myMessages") || ($page == "messageDetails")) ? 'class="active"' : null ?>href="#">Account<i class="fa fa-angle-down"></i></a>
                <ul role="menu" class="sub-menu"><?php
                  if (isset($_SESSION["userLogin"])) : ?>
                    <!-- My Account -->
                    <li><a <?= ($page == "myAccount") ? 'class="active"' : null ?>href="index.php?p=myAccount">My Account</a></li>
                    <!-- My Orders -->
                    <li><a <?= (($page == "myOrders") || ($page == "orderDetails") || ($page == "returnItems")) ? 'class="active"' : null ?>href="index.php?p=myOrders">My Orders</a></li>
                    <!-- My Returns -->
                    <li><a <?= (($page == "myReturns") || ($page == "returnDetails")) ? 'class="active"' : null ?>href="index.php?p=myReturns">My Returns</a></li>
                    <!-- My Messages -->
                    <li><a <?= (($page == "myMessages") || ($page == "messageDetails")) ? 'class="active"' : null ?>href="index.php?p=myMessages">My Messages</a></li>
                    <!-- Logout -->
                    <li><a href="index.php?p=logout">Logout</a></li><?php
                  else : ?>
                    <!-- Login -->
                    <li><a <?= ($page == "login") ? 'class="active"' : null ?>href="index.php?p=login">Login</a></li><?php
                  endif; ?>
                </ul>
              </li>
              <!-- Contact -->
              <li><a <?= ($page == "contact") ? 'class="active"' : null ?>href="index.php?p=contact">Contact</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-6">
          <!-- Search -->
          <form action="index.php?p=products" method="post" name="schHeader">
            <div class="search_box pull-right">
              <input type="text" name="prodSearch" placeholder="Search Products" value="<?= isset($_SESSION["prodSearch"]) ? $_SESSION["prodSearch"] : null ?>" autocomplete="off" /><button type="submit" name="hdrSearch"><i class="fa fa-search"></i></button><button style="border-left:thin solid" type="submit" name="hdrClear"><i class="fa fa-trash-o"></i></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div><!--/header-bottom-->  
</header>