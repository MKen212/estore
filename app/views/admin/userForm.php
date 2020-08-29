<!-- User Form -->
<div>
  <form class="ml-3" action="" method="POST" name="userForm" autocomplete="off">
    <!-- Email -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="email">Email:</label>
      <div class="inpFixed">
        <input class="form-control" type="email" name="email" id="email" placeholder="Enter Email Address" value="<?= $userData["Email"]; ?>" required autofocus />
      </div>
    </div>
    <!-- Password -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="password">Password:</label>
      <div class="inpFixed">
        <input class="form-control" type="password" name="password" minlength="5" id="password" placeholder="Enter Password" />
      </div>
    </div>
    <!-- Name -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="name">Name:</label>
      <div class="inpFixed">
        <input class="form-control" type="text" name="name" id="name" placeholder="Enter Name" value="<?= $userData["Name"]; ?>" required />
      </div>
    </div>
    <!-- IsAdmin -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="isAdmin">Admin User:</label>
      <div class="inpFixed">
        <select class="form-control" name="isAdmin" id="isAdmin" required>
          <?php statusOptions("IsAdmin", $userData["IsAdmin"]); ?>
        </select>
      </div>
    </div>
    <!-- Status -->
    <div class="form-group row">
      <label class="col-form-label labFixed" for="status">Status:</label>
      <div class="inpFixed">
        <select class="form-control" name="status" id="status" required>
          <?php statusOptions("Status", $userData["Status"]); ?>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <!-- Submit Button -->
      <div class="col-form-label labFixed">
        <button class="btn btn-primary" type="submit" name="updateUser">Update User</button>
      </div>
      <!-- Results -->
      <div class="inpFixed" id="userFormResult">
        <?php msgShow(); ?>
      </div>
    </div>
  </form>
</div>

