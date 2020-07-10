<!-- Registration Form -->
<div class="row justify-content-center">
  <form class="form-user" action="" method="POST" name="registrationForm" autocomplete="off">
    <h3 class="mb-3">User Registration Form</h3>
    <!-- Username -->
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text form-labels">Username:</span>
      </div>
      <input class="form-control" type="text" name="username" placeholder="Enter Username" required autofocus />
    </div>
    <!-- Password -->
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text form-labels">Password:</span>
      </div>
      <input class="form-control" type="password" name="password" minlength="5" placeholder="Enter Password" required />
    </div>
    <!-- Full Name -->
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text form-labels">Full Name:</span>
      </div>
      <input class="form-control" type="text" name="fullName" placeholder="Enter Full Name" required />
    </div>
    <!-- Address 1 -->
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text form-labels">Address 1:</span>
      </div>
      <input class="form-control" type="text" name="address1" placeholder="Enter Address 1" required />
    </div>
    <!-- Address 2 -->
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text form-labels">Address 2:</span>
      </div>
      <input class="form-control" type="text" name="address2" placeholder="Enter Address 2" />
    </div>
    <!-- City -->
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text form-labels">City:</span>
      </div>
      <input class="form-control" type="text" name="city" placeholder="Enter City" required />
    </div>
    <!-- Region -->
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text form-labels">Region:</span>
      </div>
      <input class="form-control" type="text" name="region" placeholder="Enter Region" />
    </div>
    <!-- Country Code -->
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text form-labels">Country:</span>
      </div>
      <select class="form-control" name="countryCode" required>
        <?php countryOptions(DEFAULTS["countryCode"]); ?>
      </select>
    </div>
    <!-- Postcode -->
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text form-labels">Postcode:</span>
      </div>
      <input class="form-control" type="text" name="postcode" placeholder="Enter Postcode" required />
    </div>
    <!-- Email -->
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text form-labels">Email:</span>
      </div>
      <input class="form-control" type="email" name="email" placeholder="Enter Email Address" required />
    </div>
    <!-- Contact Number -->
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text form-labels">Contact No:</span>
      </div>
      <input class="form-control" type="tel" name="contactNo" placeholder="Enter Contact Telephone Number" required />
    </div>
    <br />
    <!-- Submit Button -->
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="register">Register</button>
    <!-- Shop & Login Links -->
    <a class="mr-3" href="/">To eStore</a>
    <a class="ml-3" href="admin_login.php?p=login">Back to Login</a>
    <br />
  </form>
</div>
<!-- Result -->
<div class="row justify-content-center" id="adminRegRes">
</div>
