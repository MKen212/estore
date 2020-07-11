<?php  // Shop - Checkout
if (!isset($_POST["saveShopper"]) && isset($_SESSION["userLogin"])) {  // User has not yet POSTed form and IS logged In - Get User Record
  include_once("../app/models/userClass.php");
  $user = new User;
  $_POST = $user->getRecord($_SESSION["userID"]);
}

?>

<section id="cart_items"><!--checkout-->
  <div class="container">
    <div class="breadcrumbs">
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Check out</li>
      </ol>
    </div>

    <div class="register-req">
      <p>Please <a href="">Login</a> to use the billing information from your account, or continue as a Guest</p>
    </div>

    <?php
      include("../app/views/shop/shopperForm.php");

      if (isset($_POST["saveShopper"])) {  // Save ShopperInfo to $_SESSION
        $_SESSION["cart"][0]["shopperInfo"] = $_POST;
      
      // UP TO HERE - Display Cart if ShopperInfo Completed
      
      
      }

      
      
    ?>

    <div>
      <pre>
      <?php
        echo "SESSION: ";
        print_r($_SESSION);
        echo "<br />POST: ";
        print_r($_POST);
      ?>
      </pre>
    </div>

    <div class="review-payment">
      <h2>Review Order & Payment</h2>
    </div>

    <div class="table-responsive cart_info">
      <table class="table table-condensed">
        <thead>
          <tr class="cart_menu">
            <td class="image">Item</td>
            <td class="description"></td>
            <td class="price">Price</td>
            <td class="quantity">Quantity</td>
            <td class="total">Total</td>
            <td></td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="cart_product">
              <a href=""><img src="images/cart/one.png" alt=""></a>
            </td>
            <td class="cart_description">
              <h4><a href="">Colorblock Scuba</a></h4>
              <p>Web ID: 1089772</p>
            </td>
            <td class="cart_price">
              <p>$59</p>
            </td>
            <td class="cart_quantity">
              <div class="cart_quantity_button">
                <a class="cart_quantity_up" href=""> + </a>
                <input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
                <a class="cart_quantity_down" href=""> - </a>
              </div>
            </td>
            <td class="cart_total">
              <p class="cart_total_price">$59</p>
            </td>
            <td class="cart_delete">
              <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="payment-options">
        <span>
          <label><input type="checkbox"> Direct Bank Transfer</label>
        </span>
        <span>
          <label><input type="checkbox"> Check Payment</label>
        </span>
        <span>
          <label><input type="checkbox"> Paypal</label>
        </span>
      </div>
  </div>
</section><!--/checkout-->