<div class="product-details"><!--Product Details-->
  <div class="col-sm-5">
    <div class="view-product"> <!-- Main Image -->
      <img width="270" height="250" src="<?= $fullPath; ?>" alt="<?= $values["ImgFilename"]; ?>" />
    </div>

    <!-- TODO  Decide if including carousel of product images -->
    <div id="similar-product" class="carousel slide" data-ride="carousel"> <!-- Other Images -->
      <div class="carousel-inner">
        <div class="item active">
          <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
          <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
          <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
        </div>
        <div class="item">
          <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
          <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
          <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
        </div>
        <div class="item">
          <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
          <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
          <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
        </div>
      </div>
      <!-- Controls -->
      <a class="left item-control" href="#similar-product" data-slide="prev"><i class="fa fa-angle-left"></i></a>
      <a class="right item-control" href="#similar-product" data-slide="next"><i class="fa fa-angle-right"></i></a>
    </div>
  </div>

  <div class="col-sm-7">
    <div class="product-information"><!--/product-information-->
      <?php if ($values["Flag"] == 1) : ?>
        <img src="images/shop/new.png" class="new" alt="" />
      <?php elseif ($values["Flag"] == 2) : ?>
        <img src="images/shop/sale.png" class="sale" alt="" />
      <?php endif; ?>
      <h2><?= $values["Name"]; ?></h2>
      <p><?= $values["Description"]; ?></p>
      <!-- Removed Ratings as hard-coded image
      <img src="images/product-details/rating.png" alt="" />
      -->
      
      <form action="" method="POST" name="prodATCForm"><!-- Add To Cart Form -->
        <span>
          <span><?= symValue($values["Price"]); ?></span>
          <label>Quantity:</label>
          <input type="number" name="qtyOrdered" value="<?= $quantity;?>" min="<?= $quantity;?>" max="<?= $values["QtyAvail"]; ?>" />
          <button type="submit" name="addProdToCart" class="btn btn-default add-to-cart" style="margin-bottom:6px"<?= $values["QtyAvail"] <= 0 ? " disabled" : null;?>><i class="fa fa-shopping-cart"></i>Add to cart</button>
        </span>
      </form>

      <p><b>Product ID: </b><?= $selectedID; ?></p>
      <p><b>Availability: </b><?= $values["QtyAvail"] > 0 ? $values["QtyAvail"] . " In Stock" : "OUT OF STOCK";?></p>
      <p><b>Category: </b><?= $values["Category"]; ?></p>
      <p><b>Brand: </b><?= $values["Brand"]; ?></p>
      <p><b>Weight: </b><?= $values["WeightGrams"]; ?> grams</p>
      
    </div><!--/product-information-->
  </div>
</div><!--/Product Details-->

<!-- TODO  Decide how to handle Details / Review Section -->
<div class="category-tab shop-details-tab"><!--category-tab-->
  <div class="col-sm-12">
    <ul class="nav nav-tabs">
      <li><a href="#details" data-toggle="tab">Details</a></li>
      <li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
      <li><a href="#tag" data-toggle="tab">Tag</a></li>
      <li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
    </ul>
  </div>
  <div class="tab-content">
    <div class="tab-pane fade" id="details" >
      <div class="col-sm-3">
        <div class="product-image-wrapper">
          <div class="single-products">
            <div class="productinfo text-center">
              <img src="images/home/gallery1.jpg" alt="" />
              <h2>$56</h2>
              <p>Easy Polo Black Edition</p>
              <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="product-image-wrapper">
          <div class="single-products">
            <div class="productinfo text-center">
              <img src="images/home/gallery2.jpg" alt="" />
              <h2>$56</h2>
              <p>Easy Polo Black Edition</p>
              <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="product-image-wrapper">
          <div class="single-products">
            <div class="productinfo text-center">
              <img src="images/home/gallery3.jpg" alt="" />
              <h2>$56</h2>
              <p>Easy Polo Black Edition</p>
              <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="product-image-wrapper">
          <div class="single-products">
            <div class="productinfo text-center">
              <img src="images/home/gallery4.jpg" alt="" />
              <h2>$56</h2>
              <p>Easy Polo Black Edition</p>
              <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="tab-pane fade" id="companyprofile" >
      <div class="col-sm-3">
        <div class="product-image-wrapper">
          <div class="single-products">
            <div class="productinfo text-center">
              <img src="images/home/gallery1.jpg" alt="" />
              <h2>$56</h2>
              <p>Easy Polo Black Edition</p>
              <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="product-image-wrapper">
          <div class="single-products">
            <div class="productinfo text-center">
              <img src="images/home/gallery3.jpg" alt="" />
              <h2>$56</h2>
              <p>Easy Polo Black Edition</p>
              <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="product-image-wrapper">
          <div class="single-products">
            <div class="productinfo text-center">
              <img src="images/home/gallery2.jpg" alt="" />
              <h2>$56</h2>
              <p>Easy Polo Black Edition</p>
              <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="product-image-wrapper">
          <div class="single-products">
            <div class="productinfo text-center">
              <img src="images/home/gallery4.jpg" alt="" />
              <h2>$56</h2>
              <p>Easy Polo Black Edition</p>
              <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="tab-pane fade" id="tag" >
      <div class="col-sm-3">
        <div class="product-image-wrapper">
          <div class="single-products">
            <div class="productinfo text-center">
              <img src="images/home/gallery1.jpg" alt="" />
              <h2>$56</h2>
              <p>Easy Polo Black Edition</p>
              <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="product-image-wrapper">
          <div class="single-products">
            <div class="productinfo text-center">
              <img src="images/home/gallery2.jpg" alt="" />
              <h2>$56</h2>
              <p>Easy Polo Black Edition</p>
              <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="product-image-wrapper">
          <div class="single-products">
            <div class="productinfo text-center">
              <img src="images/home/gallery3.jpg" alt="" />
              <h2>$56</h2>
              <p>Easy Polo Black Edition</p>
              <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="product-image-wrapper">
          <div class="single-products">
            <div class="productinfo text-center">
              <img src="images/home/gallery4.jpg" alt="" />
              <h2>$56</h2>
              <p>Easy Polo Black Edition</p>
              <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="tab-pane fade active in" id="reviews" >
      <div class="col-sm-12">
        <ul>
          <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
          <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
          <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
        </ul>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
        <p><b>Write Your Review</b></p>
        
        <form action="#">
          <span>
            <input type="text" placeholder="Your Name"/>
            <input type="email" placeholder="Email Address"/>
          </span>
          <textarea name="" ></textarea>
          <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
          <button type="button" class="btn btn-default pull-right">
            Submit
          </button>
        </form>
      </div>
    </div>
  </div>
</div><!--/category-tab-->

<!-- TODO  Decide how to handle Recommended Items Section -->
<div class="recommended_items"><!--recommended_items-->
  <h2 class="title text-center">recommended items</h2>
  <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="item active">	
        <div class="col-sm-4">
          <div class="product-image-wrapper">
            <div class="single-products">
              <div class="productinfo text-center">
                <img src="images/home/recommend1.jpg" alt="" />
                <h2>$56</h2>
                <p>Easy Polo Black Edition</p>
                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="product-image-wrapper">
            <div class="single-products">
              <div class="productinfo text-center">
                <img src="images/home/recommend2.jpg" alt="" />
                <h2>$56</h2>
                <p>Easy Polo Black Edition</p>
                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="product-image-wrapper">
            <div class="single-products">
              <div class="productinfo text-center">
                <img src="images/home/recommend3.jpg" alt="" />
                <h2>$56</h2>
                <p>Easy Polo Black Edition</p>
                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="item">	
        <div class="col-sm-4">
          <div class="product-image-wrapper">
            <div class="single-products">
              <div class="productinfo text-center">
                <img src="images/home/recommend1.jpg" alt="" />
                <h2>$56</h2>
                <p>Easy Polo Black Edition</p>
                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="product-image-wrapper">
            <div class="single-products">
              <div class="productinfo text-center">
                <img src="images/home/recommend2.jpg" alt="" />
                <h2>$56</h2>
                <p>Easy Polo Black Edition</p>
                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="product-image-wrapper">
            <div class="single-products">
              <div class="productinfo text-center">
                <img src="images/home/recommend3.jpg" alt="" />
                <h2>$56</h2>
                <p>Easy Polo Black Edition</p>
                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
      <i class="fa fa-angle-left"></i>
      </a>
      <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
      <i class="fa fa-angle-right"></i>
      </a>			
  </div>
</div><!--/recommended_items-->
					