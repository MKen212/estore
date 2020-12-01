<!-- Home - ADMIN -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Admin Home</h2>
</div><?php

// Display Testing Information if in Testing Mode
if (DEFAULTS["testing"] == true) : ?>
  <div>
    <pre><?php
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
  </div><?php
endif; ?>

<div>
  <p>Welcome to the E-STORE Administration Tool.</p>
</div>
