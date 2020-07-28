<!-- Checkout Payment -->
<div class="review-payment" id="pay">
  <h2>Process Payment</h2>
</div>
<section id="do_payment"><!--do_payment-->
  <div class="row">
    <div class="col-sm-12">
      <form class="chose_area" action="index.php?p=orderConf" method="POST" name="paymentForm">
        <h5 style="margin-left:30px;">In future this form would re-direct you to the PayPal Payment Site for Payment Authorisation...</h5>

        <ul class="user_info">
          <li class="single_field">
            <label>Payment Type:</label>
            <select name="paymentType">
              <option selected>PayPal</option>
              <option>Credit Card</option>
              <option>Debit Card</option>
            </select>
          </li>
        </ul>
        <button class="btn btn-default update" type="submit" name="makePayment">Pay</button>
      </form>
    </div>
  </div>
</section><!--/do_payment-->