<?php  // Shop - Checkout

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

    <div class="shopper-info"><!--shopper_information-->
      <div class="row">
        <div class="col-sm-8 clearfix">
          <div class="bill-to">
            <div class="form-one"><!--billing_information-->
              <p>Bill To</p>
              <form>
                <input type="text" placeholder="Full Name">
                <input type="text" placeholder="Address 1">
                <input type="text" placeholder="Address 2">
                <input type="text" placeholder="Town/City">
                <input type="text" placeholder="State/Province/Region">
                <input type="text" placeholder="Country">
                <input type="text" placeholder="Postcode">
                <input type="text" placeholder="Email">
                <input type="text" placeholder="Contact Telephone">
              </form>
            </div><!--/billing_information-->
            <div class="form-two"><!--shipping_information-->
              <p>Ship To</p>
              <form>
                <input type="text" placeholder="Full Name">
                <input type="text" placeholder="Address 1">
                <input type="text" placeholder="Address 2">
                <input type="text" placeholder="Town/City">
                <input type="text" placeholder="State/Province/Region">
                <input type="text" placeholder="Country">
                <input type="text" placeholder="Postcode">
                <input type="text" placeholder="Email">
                <input type="text" placeholder="Contact Telephone">
              </form>
            </div><!--/shipping_information-->
          </div>
        </div>
        <div class="col-sm-4">
          <div class="order-message">
            <p>Shipping Instructions</p>
            <textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
            <label><input type="checkbox"> Copy Shipping Details from Billing Details</label>
          </div>	
        </div>					
      </div>
    </div><!--/shopper_information-->

    <div class="review-payment">
      <h2>Review & Payment</h2>
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