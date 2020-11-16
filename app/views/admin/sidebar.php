<?php include "../app/controllers/admin/sidebarBadges.php";  // Update Sidebar Badges ?>

<!-- ADMIN Sidebar Menu -->
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">
    <ul class="nav flex-column">
      <!-- Welcome -->
      <li class="nav-brand">
        <h6 class="ml-2">Welcome, <?= $_SESSION["userName"]; ?></h6>
        <hr>
      </li>
      <!-- Home -->
      <li class="nav-item">
        <a class="nav-link<?= $_GET["p"] == "home" ? " active" : "";?>" href="admin_dashboard.php?p=home"><span data-feather="home"></span>Home</a>
      </li>
      <!-- Products -->
      <li class="nav-item">
        <a class="nav-link<?= (($_GET["p"] == "products") || ($_GET["p"] == "productDetails") || ($_GET["p"] == "productAdd")) ? " active" : "";?>" href="admin_dashboard.php?p=products"><span data-feather="layers"></span>Products</a>
      </li>
      <!-- Orders -->
      <li class="nav-item">
        <a class="nav-link<?= (($_GET["p"] == "orders") || ($_GET["p"] == "orderDetails")) ? " active" : "";?>" href="admin_dashboard.php?p=orders"><span data-feather="package"></span>Orders <span style="margin-left:10px" id="toSendBadge"><?= $toSendBadge ?></span></a>
      </li>
      <!-- Returns -->
      <li class="nav-item">
        <a class="nav-link<?= (($_GET["p"] == "returns") || ($_GET["p"] == "returnDetails")) ? " active" : "";?>" href="admin_dashboard.php?p=returns"><span data-feather="download"></span>Returns<span style="margin-left:10px" id="toProcessBadge"><?= $toProcessBadge ?></span></a>
      </li>
      <!-- Messages -->
      <li class="nav-item">
        <a class="nav-link<?= (($_GET["p"] == "messages") || ($_GET["p"] == "messageDetails")) ? " active" : "";?>" href="admin_dashboard.php?p=messages"><span data-feather="send"></span>Messages<span style="margin-left:10px" id="toRespondBadge"><?= $toRespondBadge ?></span></a>
      </li>
      <!-- Users-->
      <li class="nav-item">
        <a class="nav-link<?= (($_GET["p"] == "users") || ($_GET["p"] == "userDetails") || ($_GET["p"] == "userAdd")) ? " active" : "";?>" href="admin_dashboard.php?p=users"><span data-feather="users"></span>Users</a>
        <hr />
      </li>
      <!-- Product Categories-->
      <li class="nav-item">
        <a class="nav-link<?= (($_GET["p"] == "prodCats") || ($_GET["p"] == "prodCatDetails") || ($_GET["p"] == "prodCatAdd")) ? " active" : "";?>" href="admin_dashboard.php?p=prodCats"><span data-feather="list"></span>Product Categories</a>
      </li>
      <!-- Product Brands-->
      <li class="nav-item">
        <a class="nav-link<?= (($_GET["p"] == "prodBrands") || ($_GET["p"] == "prodBrandDetails") || ($_GET["p"] == "prodBrandAdd")) ? " active" : "";?>" href="admin_dashboard.php?p=prodBrands"><span data-feather="tag"></span>Product Brands</a>
      </li>
      <!-- Shipping Rates -->
      <li class="nav-item">
        <a class="nav-link<?= (($_GET["p"] == "shipping") || ($_GET["p"] == "shippingDetails") || ($_GET["p"] == "shippingAdd")) ? " active" : "";?>" href="admin_dashboard.php?p=shipping"><span data-feather="truck"></span>Shipping Rates</a>
      </li>
      <!-- Shipping Countries -->
      <li class="nav-item">
        <a class="nav-link<?= (($_GET["p"] == "countries") || ($_GET["p"] == "countryDetails") || ($_GET["p"] == "countryAdd")) ? " active" : "";?>" href="admin_dashboard.php?p=countries"><span data-feather="map"></span>Shipping Countries</a>
        <hr />
      </li>      
      <!-- E-Store -->
      <li class="nav-item">
        <a class="nav-link logo" href="index.php?p=home"><img style="margin-right:10px" src="images/shared/logo.png" alt="logo" /><span>E</span>-STORE</a>
      </li>
    </ul>
  </div>
</nav>