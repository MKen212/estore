<div class="col-sm-8">
  <div class="contact-form">
    <h2 class="title text-center">Get In Touch</h2>
    <form action="" method="post" id="main-contact-form" class="contact-form row" name="contactForm" autocomplete="off">
      <div class="form-group col-md-6">
        <input type="text" class="form-control" name="contactName" placeholder="Name" value="<?= $contactData["Name"] ?>" required>
      </div>
      <div class="form-group col-md-6">
        <input type="email" class="form-control" name="contactEmail" placeholder="Email" value="<?= $contactData["Email"] ?>" required>
      </div>
      <div class="form-group col-md-12">
        <input type="text" class="form-control" name="contactSubject" placeholder="Subject" required>
      </div>
      <div class="form-group col-md-12">
        <textarea class="form-control" name="contactBody" id="message" rows="8" placeholder="Your Message Here" required></textarea>
      </div>
      <div class="form-group col-md-10"><?php
        msgShow();  // Show Result ?>
      </div>
      <div class="form-group col-md-2">
        <input type="submit" name="sendContact" class="btn btn-default update pull-right" value="Submit">
      </div>
    </form>
  </div>
</div>