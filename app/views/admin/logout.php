<!-- Logout Page -->
<div class="row justify-content-center mb-3">
  <h2>Goodbye.</h2>
</div>

<!-- Logout Message & cleanup -->
<div class="row justify-content-center mb-3">
  <h5>
    <?php  // Display Message & Clear the session
    if (isset($_SESSION["message"])) echo $_SESSION["message"];
    session_unset();
    session_destroy();
    ?>
  </h5>
</div>

<!-- To Shop or Re-Login -->
<div class="row justify-content-center">
  <a class="mr-3" href="/">To eStore</a>
  <a class="ml-3" href="admin.php?p=login">Back to Login</a>
</div>
