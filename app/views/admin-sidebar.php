<!-- Sidebar Menu -->
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">
    <ul class="nav flex-column">
      <!-- Welcome -->
      <li class="nav-brand">
        <h6 class="ml-2">Welcome, <?php echo $_SESSION["userName"] ?></h6>
        <hr>
      </li>
      <!-- Home -->
      <li class="nav-item">
        <a class="nav-link<?php echo $_GET["p"] == "admin-home" ? " active" : "";?>" href="admin.php?p=admin-home"><span data-feather="home"></span>Home<span class="sr-only">(current)</span></a>
      </li>
      <!-- Add Product -->
      <li class="nav-item">
        <a class="nav-link<?php echo $_GET["p"] == "admin-prodAdd" ? " active" : "";?>" href="admin.php?p=admin-prodAdd"><span data-feather="book"></span>Add Products</a>
      </li>
      <!-- Issued to Me -->
      <li class="nav-item">
        <a class="nav-link" href="admin-booksIssuedToMe.php"><span data-feather="book-open"></span>Issued to Me</a>
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