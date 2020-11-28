<!-- User Details Form - ADMIN -->
<div class="row pt-3 pb-2 mb-3 border-bottom">
  <div class="col-6">
    <h2><?= $formData["formTitle"]; ?></h2>
  </div>
  <!-- System Messages -->
  <div class="col-6"><?php
    msgShow(); ?>
  </div>
</div><?php

if (empty($userRecord)) :  // User Record not found ?>
  <div>User ID not found.</div><?php
else :  // Display User Form ?>
  <form class="ml-3" action="" method="POST" name="userForm" autocomplete="off">
    <!-- Email -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="email">Email:</label>
      <div class="inpFixed">
        <input class="form-control" type="email" name="email" id="email" placeholder="Enter Email Address" value="<?= $userRecord["Email"]; ?>" required autofocus />
      </div>
    </div>
    <!-- Password -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="password">Password:</label>
      <div class="inpFixed">
        <input class="form-control" type="password" name="password" minlength="5" id="password" placeholder="Enter Password" <?= ($formData["formUsage"] == "Add") ? "required" : null; ?> />
      </div>
    </div>
    <!-- Name -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="name">Name:</label>
      <div class="inpFixed">
        <input class="form-control" type="text" name="name" id="name" placeholder="Enter Name" value="<?= $userRecord["Name"]; ?>" required />
      </div>
    </div>
    <!-- IsAdmin -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="isAdmin">Admin User:</label>
      <div class="inpFixed">
        <select class="form-control" name="isAdmin" id="isAdmin" required><?php
          statusOptions("IsAdmin", $userRecord["IsAdmin"]); ?>
        </select>
      </div>
    </div>
    <!-- Status -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="status">Status:</label>
      <div class="inpFixed">
        <select class="form-control" name="status" id="status" required><?php
          statusOptions("Status", $userRecord["Status"]); ?>
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