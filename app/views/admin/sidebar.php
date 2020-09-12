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
        <a class="nav-link<?= $_GET["p"] == "ordersList" ? " active" : "";?>" href="admin_dashboard.php?p=ordersList"><span data-feather="package"></span>Orders</a>
      </li>
      <!-- Messages -->
      <li class="nav-item">
        <a class="nav-link" href="admin-messagesSend.php"><span data-feather="mail"></span>Messages</a>
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