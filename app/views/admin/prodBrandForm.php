<!-- Product Brand Details Form - ADMIN -->
<div class="row pt-3 pb-2 mb-3 border-bottom">
  <div class="col-6">
    <h2><?= $formData["formTitle"]; ?></h2>
  </div>
  <!-- System Messages -->
  <div class="col-6"><?php
    msgShow(); ?>
  </div>
</div><?php

if (empty($prodBrandRecord)) :  // ProdBrand Record not found ?>
  <div>Product Brand ID not found.</div><?php
else :  // Display Product Brand Form ?>
  <form class="ml-3" action="" method="POST" name="prodBrandForm" autocomplete="off">
    <!-- Name -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="name">Name:</label>
      <div class="inpFixed">
        <input class="form-control" type="text" name="name" id="name" placeholder="Enter Name" value="<?= $prodBrandRecord["Name"]; ?>" required />
      </div>
    </div>
    <!-- Status -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="status">Status:</label>
      <div class="inpFixed">
        <select class="form-control" name="status" id="status" required><?php
          statusOptions("Status", $prodBrandRecord["Status"]); ?>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <!-- Submit Button -->
      <div class="col-form-label labFixed">
        <button class="btn btn-primary" type="submit" name="<?= $formData["subName"]; ?>"><?= $formData["subText"]; ?></button>
      </div>
      <div class="inpFixed"></div>
    </div>
  </form><?php
endif; ?>