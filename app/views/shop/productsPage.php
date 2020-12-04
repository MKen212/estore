<!-- Products Page - SHOP -->
<section>
  <div class="container">
    <div class="row">
      <!-- Sidebar Sort & Category / Brand Filters -->
      <div class="col-sm-3"><?php
        include "../app/views/shop/sidebar.php";?>
      </div>
      <!-- Main Products Page -->
      <div class="col-sm-9 padding-right">
        <div class="featured_items"><!-- featured_items -->
          <h2 class="title text-center">Our Products</h2><?php
          if ($totRecords == 0) :  // No records to show ?>
            <div class="register-req">
              <p>Sorry - No products to show. Check Category or Brand Filters or Search Settings if you were expecting products to be listed.</p>
            </div><?php
          else :
            // Loop through Products and output a page of the items
            foreach ($productPage as $record) {
              include "../app/views/shop/productItem.php";
            } ?>
            <!-- Pagination Section -->
            <div class="col-sm-12">
              <ul class="pagination"><?php
                pagination($subPage, $lastPage, "index.php?p=products&sp="); ?>
              </ul>
            </div><?php
          endif; ?>
        </div><!--/featured_items--><?php
        // Show Product New/OnSale Carousel
        include "../app/views/shop/productCarousel.php";
        ?>
      </div>
    </div>
  </div>
</section>