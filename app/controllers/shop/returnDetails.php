<?php  // Shop - Return Details

?>
<section id="cart_items"><!--return_details-->
  <div class="container">
    <div class="heading">
		  <h3>Return Details</h3>
    </div>

    <?php
    msgShow();  // Show any system messages coming from orderConfirmation

    echo "<pre>";
    print_r($return);
    print_r($returnItems);
    // print_r($_POST);
    echo "Count: " . count($returnItems) . "<br/>";
    echo "</pre>";
    ?>

  </div>
</section><!--/return_details-->
    