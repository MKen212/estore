<!-- Contact Form and Contact Details - SHOP -->
<section id="contact-page">
  <div class="container">
    <!-- Title Block -->
    <div class="row">
      <div class="col-sm-12 bg">
        <h2 class="title text-center">Contact Us</h2>
      </div>
    </div>

    <!-- System Messages -->
    <div class="row"><?php
      msgShow();  // Show any system messages ?>
    </div>

    <!-- Contact Form -->
    <div class="col-sm-8">
      <div class="contact-form">
        <h2 class="title text-center">Get In Touch</h2>
        <form action="" method="post" id="main-contact-form" class="contact-form row" name="contactForm" autocomplete="off">
          <!-- Sender Name -->
          <div class="form-group col-md-6">
            <input type="text" class="form-control" name="contactName" maxlength="50" placeholder="Name" value="<?= $contactRecord["Name"] ?>" required>
          </div>
          <!-- Sender Email -->
          <div class="form-group col-md-6">
            <input type="email" class="form-control" name="contactEmail" maxlength="50" placeholder="Email" value="<?= $contactRecord["Email"] ?>" required>
          </div>
          <!-- Subject -->
          <div class="form-group col-md-12">
            <input type="text" class="form-control" name="contactSubject" maxlength="50" placeholder="Subject" value="<?= $contactRecord["Subject"] ?>" required>
          </div>
          <!-- Message Body -->
          <div class="form-group col-md-12">
            <textarea class="form-control" name="contactBody" id="message" rows="8" maxlength="500" placeholder="Your Message Here" required><?= $contactRecord["Body"] ?></textarea>
          </div>
          <div class="form-group col-md-10"></div>
          <!-- Submit Button -->
          <div class="form-group col-md-2">
            <input type="submit" name="sendContact" class="btn btn-default update pull-right" value="Submit">
          </div>
        </form>
      </div>
    </div>

    <!-- Contact Details -->
    <div class="col-sm-4">
      <div class="contact-info">
        <h2 class="title text-center">Contact Info</h2>
        <!-- Contact Address, Phone & Email -->
        <address class="text-center">
          <p>Customer Services Dept<br /><?= commaToBR(DEFAULTS["contactAddress"]) ?></p>
          <br />
          <p><a href="tel:<?= DEFAULTS["contactPhone"] ?>"><i class="fa fa-phone"></i> <?= DEFAULTS["contactPhone"] ?></a></p>
          <p><a href="mailto:<?= DEFAULTS["contactEmail"] ?>"><i class="fa fa-envelope"></i> <?= DEFAULTS["contactEmail"] ?></a></p>
        </address>
        <!-- Social Networks -->
        <div class="social-networks">
          <h2 class="title text-center">Social Networking</h2>
          <ul>
            <li>
              <a href="#"><i class="fa fa-facebook"></i></a>
            </li>
            <li>
              <a href="#"><i class="fa fa-twitter"></i></a>
            </li>
            <li>
              <a href="#"><i class="fa fa-youtube"></i></a>
            </li>
            <li>
              <a href="#"><i class="fa fa-linkedin"></i></a>
            </li>
            <li>
              <a href="#"><i class="fa fa-google-plus"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>