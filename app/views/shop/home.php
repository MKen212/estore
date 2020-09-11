<div><!--Home-->
  <h2>eStore Home</h2>
</div>

<?php // Display Welcome or Logged Out and/or latest system message
  if (isset($_SESSION["userLogin"])) echo "<h3>Welcome, {$_SESSION["userName"]}.</h3>";
  if (isset($_GET["q"])) echo "<h3>You are successfully logged out. Thanks for using eStore.</h3>";
  if (isset($_SESSION["message"])) echo "<h5>Last System Message: {$_SESSION["message"]}</h5>";
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