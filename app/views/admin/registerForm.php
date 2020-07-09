<!-- Registration Form -->
<div class="row justify-content-center">
  <form class="form-user" action="" method="POST" name="registrationForm">
    <h3 class="mb-3">User Registration Form</h3>
    <!-- Username -->
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text form-labels">Username:</span>
      </div>
      <input class="form-control" type="text" name="estUsername" placeholder="Enter Username" required autofocus />
    </div>
    <!-- Password -->
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text form-labels">Password:</span>
      </div>
      <input class="form-control" type="password" name="estPassword" minlength="5" placeholder="Enter Password" required />
    </div>
    <!-- First Name -->
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text form-labels">First Name:</span>
      </div>
      <input class="form-control" type="text" name="estFirstName" placeholder="Enter First Name" required />
    </div>
    <!-- Last Name -->
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text form-labels">Last Name:</span>
      </div>
      <input class="form-control" type="text" name="estLastName" placeholder="Enter Last Name" required />
    </div>
    <!-- Email -->
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text form-labels">Email:</span>
      </div>
      <input class="form-control" type="email" name="estEmail" placeholder="Enter Email Address" required />
    </div>
    <!-- Contact Number -->
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text form-labels">Contact No:</span>
      </div>
      <input class="form-control" type="tel" name="estContactNo" placeholder="Enter Contact Telephone Number" required />
    </div>
    <br />
    <!-- Submit Button -->
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="register">Register</button>
    <!-- Back to Login Link -->
    <a href="admin_login.php?p=login">Back to Login</a>
    <br />
  </form>
</div>
<!-- Result -->
<div class="row justify-content-center" id="adminRegRes">
</div>
