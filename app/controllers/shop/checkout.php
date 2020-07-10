<?php  // Shop - Checkout
if (isset($_SESSION["userLogin"])) {  // User is Logged In - Get User Record
  $userData = [
    "fullName" => "AdminTest",
    "Address1" => "Address One",
    "Address2" => "Address Two",
    "City" => "Lausanne",
    "Region" => "Vaud",
    "CountryCode" => "CH",
    "Postcode" => "1012",
    "Email" => "mk@213.com",
    "ContactNo" => "121212"
  ];
} else {  // User is not Logged In - Leave $userData empty
  $userData = [
  "fullName" => null,
  "Address1" => null,
  "Address2" => null,
  "City" => null,
  "Region" => null,
  "CountryCode" => DEFAULTS["countryCode"],
  "Postcode" => null,
  "Email" => null,
  "ContactNo" => null
];
}

// UP TO HERE. NEED TO CHECK WHETHER YOU CAN GET DATA FROM $_POST INSTEAD AND HOW TO CREATE EMPTY DATA WITHOUT SPECIFYING ALL THE FIELDS. CAN LOOK AT CODEIGNITER DEMO FOR OPTIONS

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

    <?php include("../app/views/shop/shopperForm.php"); ?>

    <div>
      <pre>
      <?php
        if (isset($_POST["placeOrder"])) {
          print_r($_POST);
        }
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