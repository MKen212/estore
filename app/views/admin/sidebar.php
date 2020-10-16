<?php include "../app/controllers/admin/sidebarBadges.php";  // Update Sidebar Badges ?>

<!-- Sidebar Menu -->
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
        <a class="nav-link<?= $_GET["p"] == "products" ? " active" : "";?>" href="admin_dashboard.php?p=products"><span data-feather="layers"></span>Products</a>
      </li>
      <!-- Orders -->
      <li class="nav-item">
        <a class="nav-link<?= $_GET["p"] == "orders" ? " active" : "";?>" href="admin_dashboard.php?p=orders"><span data-feather="package"></span>Orders <span style="margin-left:10px" id="toSendBadge"><?= $toSendBadge ?></span></a>
      </li>
      <!-- Returns -->
      <li class="nav-item">
        <a class="nav-link<?= $_GET["p"] == "returns" ? " active" : "";?>" href="admin_dashboard.php?p=returns"><span data-feather="download"></span>Returns<span style="margin-left:10px" id="toProcessBadge"><?= $toProcessBadge ?></span></a>
      </li>
      <!-- Users-->
      <li class="nav-item">
        <a class="nav-link<?= ($_GET["p"] == "users" || $_GET["p"] == "userDetails" ) ? " active" : "";?>" href="admin_dashboard.php?p=users"><span data-feather="users"></span>Users</a>
        <hr />
      </li>
      <!-- Product Categories-->
      <li class="nav-item">
        <a class="nav-link" href="admin-booksIssuedAdd.php"><span data-feather="list"></span>Product Categories</a>
      </li>
      <!-- Product Brands-->
      <li class="nav-item">
        <a class="nav-link" href="admin-booksIssuedAdd.php"><span data-feather="tag"></span>Product Brands</a>
      </li>
      <!-- Shipping Rates -->
      <li class="nav-item">
        <a class="nav-link" href="admin-booksIssuedRtn.php"><span data-feather="truck"></span>Shipping Rates</a>
      </li>
      <!-- Shipping Countries -->
      <li class="nav-item">
        <a class="nav-link" href="admin-booksAdd.php"><span data-feather="map"></span>Shipping Countries</a>
        <hr />
      </li>      
      <!-- eStore -->
      <li class="nav-item">
        <a class="nav-link" href="index.php?p=home"><img src="/images/shared/logo.png" alt="logo" /> eStore</a>
      </li>
    </ul>
  </div>
</nav>