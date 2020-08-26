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
        <a class="nav-link<?= $_GET["p"] == "home" ? " active" : "";?>" href="admin_dashboard.php?p=home"><span data-feather="home"></span>Home<span class="sr-only">(current)</span></a>
      </li>
      <!-- Add Product -->
      <li class="nav-item">
        <a class="nav-link<?= $_GET["p"] == "productAdd" ? " active" : "";?>" href="admin_dashboard.php?p=productAdd"><span data-feather="book"></span>Add Products</a>
      </li>
      <!-- List Orders -->
      <li class="nav-item">
        <a class="nav-link<?= $_GET["p"] == "ordersList" ? " active" : "";?>" href="admin_dashboard.php?p=ordersList"><span data-feather="layers"></span>List Orders</a>
      </li>
      <!-- Send a Message -->
      <li class="nav-item">
        <a class="nav-link" href="admin-messagesSend.php"><span data-feather="send"></span>Send a Message</a>
        <hr />
      </li>
      <!-- My Profile -->
      <li class="nav-item">
        <a class="nav-link" href="admin-usersProfile.php"><span data-feather="user"></span>My Profile</a>
        <hr />
      </li>
      <!-- Issue Books-->
      <li class="nav-item">
        <a class="nav-link" href="admin-booksIssuedAdd.php"><span data-feather="arrow-up-circle"></span>Issue Books</a>
      </li>
      <!-- Return Books -->
      <li class="nav-item">
        <a class="nav-link" href="admin-booksIssuedRtn.php"><span data-feather="arrow-down-circle"></span>Return Books</a>
      </li>
      <!-- Add Books -->
      <li class="nav-item">
        <a class="nav-link" href="admin-booksAdd.php"><span data-feather="plus-circle"></span>Add Books</a>
      </li>
      <!-- List/Edit Books -->
      <li class="nav-item">
        <a class="nav-link" href="admin-booksList.php"><span data-feather="layers"></span>List/Edit Books</a>
      </li>
      <!-- List/Edit Users-->
      <li class="nav-item">
        <a class="nav-link" href="admin-usersList.php"><span data-feather="users"></span>List/Edit Users</a>
      </li>
    </ul>
  </div>
</nav>