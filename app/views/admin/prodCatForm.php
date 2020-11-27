<!-- Product Category Form -->
<div>
  <form class="ml-3" action="" method="POST" name="prodCatForm" autocomplete="off">
    <!-- Name -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="name">Name:</label>
      <div class="inpFixed">
        <input class="form-control" type="text" name="name" id="name" placeholder="Enter Name" value="<?= $prodCatData["Name"]; ?>" required />
      </div>
    </div>
    <!-- Status -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="status">Status:</label>
      <div class="inpFixed">
        <select class="form-control" name="status" id="status" required><?php
          statusOptions("Status", $prodCatData["Status"]); ?>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <!-- Submit Button -->
      <div class="col-form-label labFixed">
        <button class="btn btn-primary" type="submit" name="<?= $formData["subName"]; ?>"><?= $formData["subText"]; ?></button>
      </div>
      <!-- Results -->
      <div class="inpFixed" id="prodCatFormResult"><?php
        msgShow(); ?>
      </div>
    </div>
  </form>
</div>