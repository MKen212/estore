<!-- Checkout Summary -->
<section id="do_action"><!--do_action-->
  <div class="container">
    <div class="row do_action">
      <div class="col-sm-6">
        <div class="chose_area">
          <ul class="user_info">
            <li class="single_field">
              <label>Country:</label>
              <select>
                <option>United States</option>
                <option>Bangladesh</option>
                <option>UK</option>
                <option>India</option>
                <option>Pakistan</option>
                <option>Ucrane</option>
                <option>Canada</option>
                <option>Dubai</option>
              </select>
              
            </li>
            <li class="single_field">
              <label>Region / State:</label>
              <select>
                <option>Select</option>
                <option>Dhaka</option>
                <option>London</option>
                <option>Dillih</option>
                <option>Lahore</option>
                <option>Alaska</option>
                <option>Canada</option>
                <option>Dubai</option>
              </select>
            
            </li>
            <li class="single_field zip-field">
              <label>Zip Code:</label>
              <input type="text">
            </li>
          </ul>
          <a class="btn btn-default update" href="">Get Quotes</a>
          <a class="btn btn-default check_out" href="">Continue</a>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="total_area">
          <ul>
            <li>Cart Sub Total <span><?= symValue($cart0["subTotal"]); ?></span></li>
            <li>Shipping Cost <span><?= symValue($cart0["shippingCost"]); ?></span></li>
            <li>TOTAL <span><?= symValue($cart0["total"]); ?></span></li>
          </ul>
            <a class="btn btn-default update" href="">Update</a>
            <a class="btn btn-default check_out" href="">Check Out</a>
        </div>
      </div>
    </div>
  </div>
</section><!--/do_action-->